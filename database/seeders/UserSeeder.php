<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin HotelKu',
            'email' => 'admin@hotelku.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Resepsionis HotelKu',
            'email' => 'resepsionis@hotelku.com',
            'password' => Hash::make('password123'),
            'role' => 'resepsionis',
        ]);

        User::create([
            'nama' => 'Pelanggan Satu',
            'email' => 'pelanggan1@hotelku.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        User::create([
            'nama' => 'Pelanggan Dua',
            'email' => 'pelanggan2@hotelku.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);
    }
}