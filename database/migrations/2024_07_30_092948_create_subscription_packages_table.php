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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->morphs('subscribable'); // This will create `subscribable_id` and `subscribable_type` columns
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 8, 2); // Subscription amount
            $table->date('start_date'); // Subscription start date
            $table->date('end_date')->nullable(); // Subscription end date
            $table->boolean('is_active')->default(true); // Subscription status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_packages');
    }
};
