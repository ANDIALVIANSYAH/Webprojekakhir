<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diskon;
use Carbon\Carbon;

class DiskonSeeder extends Seeder
{
    public function run(): void
    {
        Diskon::create([
            'kamar_id' => 1, // Kamar 101
            'kode_diskon' => 'DISKON10',
            'persentase_diskon' => 10.00,
            'tanggal_mulai' => Carbon::today(),
            'tanggal_selesai' => Carbon::today()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'kamar_id' => 2, // Kamar 102
            'kode_diskon' => 'DISKON20',
            'persentase_diskon' => 20.00,
            'tanggal_mulai' => Carbon::today(),
            'tanggal_selesai' => Carbon::today()->addDays(15),
            'is_active' => true,
        ]);
    }
}