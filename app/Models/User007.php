<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class user007 extends Authenticatable
{
    use HasFactory;

    protected $table = 'users_007';

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking007::class, 'user_id');
    }
}
