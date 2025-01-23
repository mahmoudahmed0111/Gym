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
        Schema::create('trainee_progress', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->date('upload_date');
            $table->unsignedBigInteger('trainee_id');
            $table->foreign('trainee_id')->references('id')->on('trainees')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_progress');
    }
};
