<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'booking_id', 'jumlah_bayar', 'metode_pembayaran', 'status_pembayaran', 'bukti_transfer'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}