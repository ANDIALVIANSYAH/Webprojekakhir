<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{

    public function uploadBukti(Request $request, Transaksi $transaksi)
    {
        if ($transaksi->booking->user_id !== Auth::user()->id) {
            return redirect()->route('booking.riwayat')->with('error', 'Akses ditolak.');
        }

        if ($transaksi->metode_pembayaran !== 'transfer_bank') {
            return redirect()->route('booking.riwayat')->with('error', 'Upload bukti hanya untuk metode transfer bank.');
        }

        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti_transfer.required' => 'Bukti transfer wajib diunggah.',
            'bukti_transfer.image' => 'File harus berupa gambar.',
            'bukti_transfer.mimes' => 'Gambar harus berupa JPG, JPEG, atau PNG.',
            'bukti_transfer.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($transaksi->bukti_transfer) {
            Storage::disk('public')->delete($transaksi->bukti_transfer);
        }

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        $transaksi->update(['bukti_transfer' => $path]);

        return redirect()->route('booking.riwayat')->with('success', 'Bukti transfer berhasil diunggah.');
    }
}