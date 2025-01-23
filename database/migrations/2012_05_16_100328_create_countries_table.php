<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // ISO 3166-1 alpha-2 code
            $table->string('phone_code')->unique(); // Phone country code
            $table->timestamps();
        });

        // Seed the table with initial countries
        DB::table('countries')->insert([
            ['name' => 'United States', 'code' => 'US', 'phone_code' => '+1'],
            ['name' => 'Egypt', 'code' => 'EG', 'phone_code' => '+20'],
            ['name' => 'Saudi Arabia', 'code' => 'SA', 'phone_code' => '+966'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
