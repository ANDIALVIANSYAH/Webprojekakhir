<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->timestamp('checkin_at')->nullable()->after('status');
            $table->timestamp('checkout_at')->nullable()->after('checkin_at');
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn(['checkin_at', 'checkout_at']);
        });
    }
};