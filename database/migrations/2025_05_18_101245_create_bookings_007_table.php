<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings_007', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users_007')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms_007')->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['Booked', 'Checked-in', 'Checked-out', 'Cancelled'])->default('Booked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings_007');
    }
};
