<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room007 extends Model
{
    use HasFactory;

    protected $table = 'rooms_007';

    protected $fillable = [
        'room_name', 'capacity', 'price', 'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking007::class, 'room_id');
    }
}
