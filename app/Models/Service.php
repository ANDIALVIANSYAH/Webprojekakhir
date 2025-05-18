<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit (karena kita pakai nama khusus)
    protected $table = 'services_007';

    // Kolom yang bisa diisi massal (fillable)
    protected $fillable = [
        'service_name',
        'service_price',
    ];

    /**
     * Relasi Many-to-Many ke Booking
     */
    public function bookings()
    {
        return $this->belongsToMany(Booking007::class, 'booking_service_007', 'service_id', 'booking_id')
                    ->withTimestamps();
    }
}
