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
        Schema::create('trainee_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainee_id')->constrained()->onDelete('cascade'); // Link to trainees table
            $table->foreignId('coach_id')->constrained()->onDelete('cascade'); // Link to trainees table
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('status')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('bmi')->nullable();
            $table->string('body_fat_percentage')->nullable();
            $table->string('body_water_percentage')->nullable();
            $table->string('muscle_mass')->nullable();
            $table->string('resting_heart_rate')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->text('health_conditions')->nullable();
            $table->date('membership_start_date');
            $table->date('membership_end_date')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_profiles');
    }
};
