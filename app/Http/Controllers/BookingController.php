<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Transaksi;
use App\Models\AuditLog;
use App\Mail\BookingConfirmed;
use App\Notifications\BookingConfirmedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::with(['user', 'kamar'])->get();
        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        $kamars = Kamar::where('status_tersedia', true)->get();
        return view('booking.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'metode_pembayaran' => 'required|in:transfer_bank,kartu_kredit,tunai',
            'kode_diskon' => 'nullable|exists:diskon,kode_diskon',
        ], [
            'kamar_id.required' => 'Kamar wajib dipilih.',
            'kamar_id.exists' => 'Kamar tidak valid.',
            'tanggal_checkin.required' => 'Tanggal check-in wajib diisi.',
            'tanggal_checkin.after_or_equal' => 'Tanggal check-in harus hari ini atau setelahnya.',
            'tanggal_checkout.required' => 'Tanggal check-out wajib diisi.',
            'tanggal_checkout.after' => 'Tanggal check-out harus setelah tanggal check-in.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
            'kode_diskon.exists' => 'Kode diskon tidak valid.',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);

        // Validasi ketersediaan kamar berdasarkan tanggal
        $existingBooking = Booking::where('kamar_id', $request->kamar_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanggal_checkin', [$request->tanggal_checkin, $request->tanggal_checkout])
                    ->orWhereBetween('tanggal_checkout', [$request->tanggal_checkin, $request->tanggal_checkout])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('tanggal_checkin', '<=', $request->tanggal_checkin)
                          ->where('tanggal_checkout', '>=', $request->tanggal_checkout);
                    });
            })
            ->whereIn('status', ['pending', 'dikonfirmasi'])
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'Kamar tidak tersedia untuk tanggal yang dipilih.');
        }

        $checkin = new \DateTime($request->tanggal_checkin);
        $checkout = new \DateTime($request->tanggal_checkout);
        $days = $checkin->diff($checkout)->days;
        $total_harga = $days * $kamar->harga_per_malam;

        // Terapkan diskon jika ada
        if ($request->filled('kode_diskon')) {
            $diskon = \App\Models\Diskon::where('kode_diskon', $request->kode_diskon)
                ->where('kamar_id', $kamar->id)
                ->where('is_active', true)
                ->where('tanggal_mulai', '<=', now())
                ->where('tanggal_selesai', '>=', now())
                ->first();

            if ($diskon) {
                $total_harga -= ($total_harga * ($diskon->persentase_diskon / 100));
            } else {
                return redirect()->back()->with('error', 'Kode diskon tidak valid atau tidak berlaku.');
            }
        }

        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'user_id' => Auth::user()->id,
                'kamar_id' => $request->kamar_id,
                'tanggal_checkin' => $request->tanggal_checkin,
                'tanggal_checkout' => $request->tanggal_checkout,
                'total_harga' => $total_harga,
                'status' => 'pending',
            ]);

            Transaksi::create([
                'booking_id' => $booking->id,
                'jumlah_bayar' => $total_harga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => 'pending',
            ]);

            $kamar->update(['status_tersedia' => false]);

            AuditLog::create([
                'user_id' => Auth::user()->id,
                'action' => 'create',
                'model' => 'Booking',
                'model_id' => $booking->id,
                'description' => 'Membuat booking untuk kamar ' . $kamar->nomor_kamar,
            ]);

            DB::commit();
            return redirect()->route('customer.dashboard')->with('success', 'Booking dan pembayaran berhasil dibuat. Menunggu konfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat booking: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,selesai,dibatalkan',
        ], [
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status tidak valid.',
        ]);

        DB::beginTransaction();
        try {
            if ($request->status == 'dikonfirmasi' && $booking->status != 'dikonfirmasi') {
                $transaksi = Transaksi::where('booking_id', $booking->id)->first();
                if ($transaksi) {
                    $transaksi->update(['status_pembayaran' => 'lunas']);
                    Mail::to($booking->user->email)->send(new BookingConfirmed($booking));
                    $booking->user->notify(new BookingConfirmedNotification($booking));
                }
            } elseif ($request->status == 'dibatalkan' && $booking->status != 'dibatalkan') {
                $kamar = Kamar::findOrFail($booking->kamar_id);
                $kamar->update(['status_tersedia' => true]);
                $transaksi = Transaksi::where('booking_id', $booking->id)->first();
                if ($transaksi) {
                    $transaksi->update(['status_pembayaran' => 'gagal']);
                }
            } elseif ($request->status == 'selesai' && $booking->status != 'selesai') {
                $kamar = Kamar::findOrFail($booking->kamar_id);
                $kamar->update(['status_tersedia' => true]);
            }

            $booking->update(['status' => $request->status]);

            AuditLog::create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'model' => 'Booking',
                'model_id' => $booking->id,
                'description' => 'Mengubah status booking menjadi ' . $request->status,
            ]);

            DB::commit();
            return redirect()->route('booking.index')->with('success', 'Status booking berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui status booking: ' . $e->getMessage());
        }
    }

    public function checkin(Booking $booking)
    {
        if ($booking->status != 'dikonfirmasi') {
            return redirect()->route('booking.index')->with('error', 'Booking harus dikonfirmasi terlebih dahulu.');
        }

        $booking->update(['checkin_at' => now()]);

        AuditLog::create([
            'user_id' => Auth::user()->id,
            'action' => 'checkin',
            'model' => 'Booking',
            'model_id' => $booking->id,
            'description' => 'Mencatat check-in untuk booking kamar ' . $booking->kamar->nomor_kamar,
        ]);

        return redirect()->route('booking.index')->with('success', 'Check-in berhasil dicatat.');
    }

    public function checkout(Booking $booking)
    {
        if (!$booking->checkin_at) {
            return redirect()->route('booking.index')->with('error', 'Booking harus check-in terlebih dahulu.');
        }

        $booking->update(['checkout_at' => now(), 'status' => 'selesai']);
        $kamar = Kamar::findOrFail($booking->kamar_id);
        $kamar->update(['status_tersedia' => true]);

        AuditLog::create([
            'user_id' => Auth::user()->id,
            'action' => 'checkout',
            'model' => 'Booking',
            'model_id' => $booking->id,
            'description' => 'Mencatat check-out untuk booking kamar ' . $booking->kamar->nomor_kamar,
        ]);

        return redirect()->route('booking.index')->with('success', 'Check-out berhasil dicatat.');
    }

    public function destroy(Booking $booking)
    {
        DB::beginTransaction();
        try {
            $kamar = Kamar::findOrFail($booking->kamar_id);
            $kamar->update(['status_tersedia' => true]);
            $transaksi = Transaksi::where('booking_id', $booking->id)->first();
            if ($transaksi) {
                $transaksi->update(['status_pembayaran' => 'gagal']);
            }

            AuditLog::create([
                'user_id' => Auth::user()->id,
                'action' => 'delete',
                'model' => 'Booking',
                'model_id' => $booking->id,
                'description' => 'Menghapus booking kamar ' . $kamar->nomor_kamar,
            ]);

            $booking->delete();
            DB::commit();
            return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus booking: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $bookings = Booking::where('user_id', Auth::user()->id)->with(['kamar', 'transaksi'])->get();
        return view('booking.riwayat', compact('bookings'));
    }
}