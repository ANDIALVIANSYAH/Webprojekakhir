<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        Kamar::create([
            'nomor_kamar' => '101',
            'tipe_kamar' => 'Deluxe',
            'harga_per_malam' => 500000,
            'deskripsi' => 'Kamar deluxe dengan pemandangan laut.',
            'gambar' => 'deluxe.jpg',
            'status_tersedia' => true,
        ]);

        Kamar::create([
            'nomor_kamar' => '102',
            'tipe_kamar' => 'Standard',
            'harga_per_malam' => 300000,
            'deskripsi' => 'Kamar standar yang nyaman.',
            'gambar' => 'standard.jpg',
            'status_tersedia' => true,
        ]);

        Kamar::create([
            'nomor_kamar' => '201',
            'tipe_kamar' => 'Suite',
            'harga_per_malam' => 750000,
            'deskripsi' => 'Kamar suite dengan fasilitas premium.',
            'gambar' => 'suite.jpg',
            'status_tersedia' => false,
        ]);
    }
}