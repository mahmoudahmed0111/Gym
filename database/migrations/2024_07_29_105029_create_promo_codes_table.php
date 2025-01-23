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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'fixed']);
            $table->double('value', 20, 4);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->nullableMorphs('owner');
            $table->foreignId("category_id")->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId("product_id")->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId("category_product_id")->nullable()->constrained()->cascadeOnDelete();
            $table->enum('applicable_scope', ['booking' , 'product'])->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
