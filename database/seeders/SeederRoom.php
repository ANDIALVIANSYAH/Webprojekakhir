<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederRoom extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms_007')->insert([
            [
                'room_name' => 'Ruang Meeting A',
                'capacity' => 30,
                'price' => 500000,
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_name' => 'Ruang Workshop B',
                'capacity' => 50,
                'price' => 750000,
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
