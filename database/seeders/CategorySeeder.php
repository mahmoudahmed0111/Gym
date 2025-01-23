<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coaching\Coach;
use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coaches = Coach::all(); // Get all coaches, or use specific IDs if known

        $categories = [
            ['name' => 'Fitness', 'desc' => 'Fitness sports category', 'image' => 'Fitness.jpg', 'type' => 'category'],
            ['name' => 'Yoga', 'desc' => 'Yoga sports category', 'image' => 'Yoga.jpg', 'type' => 'category'],
            ['name' => 'Dance', 'desc' => 'Dance sports category', 'image' => 'Dance.jpg', 'type' => 'category'],
            ['name' => 'Cardio', 'desc' => 'Cardio sports category', 'image' => 'Cardio.jpg', 'type' => 'training'],
            ['name' => 'Push', 'desc' => 'Push sports category', 'image' => 'Push.jpg', 'type' => 'training'],
            ['name' => 'Pull', 'desc' => 'Pull sports category', 'image' => 'Pull.jpg', 'type' => 'training'],
            ['name' => 'Leg', 'desc' => 'Leg sports category', 'image' => 'Leg.jpg', 'type' => 'training'],
        ];

        foreach ($categories as $category) {
            $cat = Category::create($category);

            foreach ($coaches as $coach) {
                $cat->coaches()->attach($coach->id);
            }
        }
}
}
