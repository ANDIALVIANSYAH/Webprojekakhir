<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_mulai = $request->input('tanggal_mulai', Carbon::today()->startOfMonth()->toDateString());
        $tanggal_selesai = $request->input('tanggal_selesai', Carbon::today()->toDateString());

        try {
            $bookings = Booking::whereBetween('tanggal_checkin', [$tanggal_mulai, $tanggal_selesai])
                ->where('status', 'selesai')
                ->with(['kamar', 'user'])
                ->get();

            $total_pendapatan = $bookings->sum('total_harga');

            return view('laporan.index', compact('bookings', 'total_pendapatan', 'tanggal_mulai', 'tanggal_selesai'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat laporan.');
        }
    }
}