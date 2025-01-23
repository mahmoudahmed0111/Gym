<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['name' => 'New York', 'country_id' => 1, 'lat' => 40.7128, 'lng' => -74.0060],
            ['name' => 'Cairo', 'country_id' => 2, 'lat' => 30.0444, 'lng' => 31.2357],
            ['name' => 'Riyadh', 'country_id' => 3, 'lat' => 24.7136, 'lng' => 46.6753],
        ]);
    }
}
