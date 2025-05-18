<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking007;
use App\Models\Service;

class SeederBookings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Buat booking baru dengan Eloquent
        $booking = Booking007::create([
            'user_id' => 3, // asumsi user_id valid
            'room_id' => 1, // asumsi room_id valid
            'start_time' => '2025-05-10 09:00:00',
            'end_time' => '2025-05-10 12:00:00',
            'status' => 'Booked',
        ]);
        
        // Ambil beberapa service id yang mau di-attach ke booking ini
        // Contoh: service dengan id 1 dan 2
        $serviceIds = [1, 2];

        // Attach service ke booking, otomatis isi tabel pivot booking_service_007
        $booking->services()->attach($serviceIds);
    }
}
