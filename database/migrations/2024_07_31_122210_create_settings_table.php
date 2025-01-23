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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("facebook_link")->nullable();
            $table->string("instagram_link")->nullable();
            $table->string("whats_up")->nullable();
            $table->string("phone")->nullable();
            $table->string("x_link")->nullable();
            $table->string("website")->nullable();
            $table->string("snapchat")->nullable();
            $table->string("tax")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
