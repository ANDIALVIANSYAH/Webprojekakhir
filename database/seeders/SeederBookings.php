<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SeederBookings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings_007')->insert([
            [
                'user_id' => 3, // asumsi 'Budi Pelanggan' punya id 3
                'room_id' => 1, // asumsi 'Ruang Meeting A' punya id 1
                'start_time' => '2025-05-10 09:00:00',
                'end_time' => '2025-05-10 12:00:00',
                'status' => 'Booked',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
