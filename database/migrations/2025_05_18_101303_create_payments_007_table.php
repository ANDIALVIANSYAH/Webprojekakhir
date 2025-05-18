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
      Schema::create('payments_007', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings_007')->onDelete('cascade');
            $table->decimal('amount_paid', 10, 2);
            $table->enum('payment_method', ['Credit Card', 'Bank Transfer', 'Cash', 'Online Payment']);
            $table->enum('payment_status', ['Pending', 'Completed', 'Failed', 'Refunded'])->default('Pending');
            $table->dateTime('payment_date');
            $table->string('transaction_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments_007');
    }
};
