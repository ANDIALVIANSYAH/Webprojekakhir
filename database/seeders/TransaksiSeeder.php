<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        Transaksi::create([
            'booking_id' => 1,
            'jumlah_bayar' => 900000,
            'metode_pembayaran' => 'transfer_bank',
            'status_pembayaran' => 'pending',
        ]);

        Transaksi::create([
            'booking_id' => 2,
            'jumlah_bayar' => 480000,
            'metode_pembayaran' => 'kartu_kredit',
            'status_pembayaran' => 'lunas',
        ]);
    }
}