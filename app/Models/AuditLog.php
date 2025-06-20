<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';
    protected $fillable = [
        'user_id', 'action', 'model', 'model_id', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}