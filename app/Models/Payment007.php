<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment007 extends Model
{
    use HasFactory;

    protected $table = 'payments_007';

    protected $fillable = [
        'booking_id',
        'amount_paid',
        'payment_method',
        'payment_status',
        'payment_date',
        'transaction_reference',
    ];

    /**
     * Relasi One-to-One ke Booking007
     */
    public function booking()
    {
        return $this->belongsTo(Booking007::class, 'booking_id');
    }
}
