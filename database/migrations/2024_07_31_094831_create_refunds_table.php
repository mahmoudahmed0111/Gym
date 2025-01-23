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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');
            $table->unsignedBigInteger('booking_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');
            $table->string('reason')->nullable();
            $table->timestamps();
            // $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
