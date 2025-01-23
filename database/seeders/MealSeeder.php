<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $coach_id = 1; // Adjust as necessary

        DB::table('meals')->insert([
            [
                'name' => 'Breakfast Special 1',
                'desc' => 'A high-protein breakfast meal.',
                'amount' => '300',
                'fat' => '15',
                'carbohydrate' => '45',
                'protein' => '25',
                'coach_id' => $coach_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lunch Combo 1',
                'desc' => 'A balanced meal for lunch.',
                'amount' => '400',
                'fat' => '20',
                'carbohydrate' => '50',
                'protein' => '30',
                'coach_id' => $coach_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dinner Delight 1',
                'desc' => 'A light and nutritious dinner.',
                'amount' => '250',
                'fat' => '10',
                'carbohydrate' => '35',
                'protein' => '20',
                'coach_id' => $coach_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
        $coach_id = 2; // Adjust as necessary

        DB::table('meals')->insert([
            [
                'name' => 'Breakfast Special 2',
                'desc' => 'A high-protein breakfast meal.',
                'amount' => '300',
                'fat' => '15',
                'carbohydrate' => '45',
                'protein' => '25',
                'coach_id' => $coach_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lunch Combo 2',
                'desc' => 'A balanced meal for lunch.',
                'amount' => '400',
                'fat' => '20',
                'carbohydrate' => '50',
                'protein' => '30',
                'coach_id' => $coach_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dinner Delight 2',
                'desc' => 'A light and nutritious dinner.',
                'amount' => '250',
                'fat' => '10',
                'carbohydrate' => '35',
                'protein' => '20',
                'coach_id' => $coach_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
    }
}
