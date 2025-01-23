<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // ISO code for the currency
            $table->string('symbol');
            $table->decimal('exchange_rate', 15, 2); // Exchange rate relative to a base currency, e.g., USD
            $table->unsignedBigInteger('country_id'); // Foreign key to countries table
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->timestamps();
        });

        // Seed the table with initial currencies
        DB::table('currencies')->insert([
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$', 'exchange_rate' => 1.00, 'country_id' => 1],
            ['name' => 'Egyptian Pound', 'code' => 'EGP', 'symbol' => 'جنيه', 'exchange_rate' => 47.50, 'country_id' => 2], // Example rate
            ['name' => 'Saudi Riyal', 'code' => 'SAR', 'symbol' => 'ريال', 'exchange_rate' => 3.75, 'country_id' => 3], // Example rate
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
