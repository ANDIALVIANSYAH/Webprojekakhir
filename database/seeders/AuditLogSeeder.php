<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditLog;
use Carbon\Carbon;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        AuditLog::create([
            'user_id' => 1, // Admin
            'action' => 'create',
            'model' => 'Booking',
            'model_id' => 1,
            'description' => 'Membuat booking untuk kamar 101',
            'created_at' => Carbon::now(),
        ]);

        AuditLog::create([
            'user_id' => 2, // Resepsionis
            'action' => 'update',
            'model' => 'Booking',
            'model_id' => 2,
            'description' => 'Mengubah status booking menjadi dikonfirmasi',
            'created_at' => Carbon::now(),
        ]);
    }
}