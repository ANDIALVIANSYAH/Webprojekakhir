<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str; 

class SeederPayments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengambil semua booking yang ada di tabel bookings_007
        $bookings = DB::table('bookings_007')->pluck('id');
        
        foreach ($bookings as $bookingId) {
            // Insert data pembayaran untuk setiap booking
            DB::table('payments_007')->insert([
                [
                    'booking_id' => $bookingId,
                    'amount_paid' => rand(100000, 1000000) / 100,  // Menghasilkan nilai acak untuk jumlah pembayaran
                    'payment_method' => collect(['Credit Card', 'Bank Transfer', 'Cash', 'Online Payment'])->random(),
                    'payment_status' => collect(['Pending', 'Completed', 'Failed', 'Refunded'])->random(),
                    'payment_date' => Carbon::now(),
                    'transaction_reference' => Str::uuid()->toString(),  // Menggunakan Str::uuid() untuk UUID
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
