<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $coach_id_1 = 1; // You may need to adjust this depending on your data

        DB::table('food')->insert([
            [
                'name' => 'Chicken Breast',
                'img' => 'path/to/image.jpg',
                'amount' => '100',
                'fat' => '1',
                'carbohydrate' => '0',
                'protein' => '22',
                'coach_id' => $coach_id_1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Broccoli',
                'img' => 'path/to/image.jpg',
                'amount' => '150',
                'fat' => '0',
                'carbohydrate' => '10',
                'protein' => '3',
                'coach_id' => $coach_id_1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
        $coach_id_2 = 2; // You may need to adjust this depending on your data

        DB::table('food')->insert([
            [
                'name' => 'Meat',
                'img' => 'path/to/image.jpg',
                'amount' => '100',
                'fat' => '1',
                'carbohydrate' => '0',
                'protein' => '22',
                'coach_id' => $coach_id_2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'vegetables',
                'img' => 'path/to/image.jpg',
                'amount' => '150',
                'fat' => '0',
                'carbohydrate' => '10',
                'protein' => '3',
                'coach_id' => $coach_id_2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
    }
}
