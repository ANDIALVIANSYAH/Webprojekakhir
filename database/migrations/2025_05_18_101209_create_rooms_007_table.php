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
        Schema::create('rooms_007', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['Available', 'Booked'])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_007');
    }
};
