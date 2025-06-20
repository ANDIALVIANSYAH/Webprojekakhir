<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'user_id' => 3, // Pelanggan Satu
            'kamar_id' => 1, // Kamar 101
            'tanggal_checkin' => Carbon::today(),
            'tanggal_checkout' => Carbon::today()->addDays(2),
            'total_harga' => 900000, // Setelah diskon 10%
            'status' => 'pending',
        ]);

        Booking::create([
            'user_id' => 4, // Pelanggan Dua
            'kamar_id' => 2, // Kamar 102
            'tanggal_checkin' => Carbon::today()->addDays(1),
            'tanggal_checkout' => Carbon::today()->addDays(3),
            'total_harga' => 480000, // Setelah diskon 20%
            'status' => 'dikonfirmasi',
        ]);
    }
}