<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $fillable = [
        'user_id', 'kamar_id', 'tanggal_checkin', 'tanggal_checkout', 'total_harga', 'status', 'checkin_at', 'checkout_at'
    ];

    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
        'checkin_at' => 'datetime',
        'checkout_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}