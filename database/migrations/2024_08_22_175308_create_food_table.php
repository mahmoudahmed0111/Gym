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
    Schema::create('food', function (Blueprint $table) {
        $table->id(); // Assuming this is an unsigned big integer
        $table->string('name');
        $table->string('img');
        $table->string('amount');
        $table->string('fat');
        $table->string('carbohydrate');
        $table->string('protein');
        $table->unsignedBigInteger('coach_id'); // Foreign key for trainee
        $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
