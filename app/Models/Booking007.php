<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking007 extends Model
{
    use HasFactory;

    protected $table = 'bookings_007';

    protected $fillable = [
        'user_id', 'room_id', 'start_time', 'end_time', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User007::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room007::class, 'room_id');
    }

    public function payment()
    {
    return $this->hasOne(Payment007::class, 'booking_id');
    }

}
