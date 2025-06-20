<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $fillable = [
        'nomor_kamar', 'tipe_kamar', 'harga_per_malam', 'deskripsi', 'gambar', 'status_tersedia'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function diskon()
    {
        return $this->hasOne(Diskon::class);
    }
}