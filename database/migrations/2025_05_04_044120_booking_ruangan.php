<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Users
        Schema::create('users_007', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Receptionist', 'Customer']);
            $table->timestamps();
        });

        // Tabel Rooms
        Schema::create('rooms_007', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['Available', 'Booked'])->default('Available');
            $table->timestamps();
        });

        // Tabel Bookings
        Schema::create('bookings_007', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users_007')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms_007')->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['Booked', 'Checked-in', 'Checked-out', 'Cancelled'])->default('Booked');
            $table->timestamps();
        });

        // Tabel Payments
        Schema::create('payments_007', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings_007')->onDelete('cascade');
            $table->decimal('amount_paid', 10, 2);
            $table->enum('payment_method', ['Credit Card', 'Bank Transfer', 'Cash', 'Online Payment']);
            $table->enum('payment_status', ['Pending', 'Completed', 'Failed', 'Refunded'])->default('Pending');
            $table->dateTime('payment_date');
            $table->string('transaction_reference')->nullable();  // Optional, for tracking the transaction
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments_007');
        Schema::dropIfExists('bookings_007');
        Schema::dropIfExists('rooms_007');
        Schema::dropIfExists('users_007');
    }
};
