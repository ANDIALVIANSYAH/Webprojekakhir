<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskon';
    protected $fillable = [
        'kamar_id', 'kode_diskon', 'persentase_diskon', 'tanggal_mulai', 'tanggal_selesai', 'is_active'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}