<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PackageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CitiesTableSeeder::class,
            CategorySeeder::class,
            AdminSeeder::class,
            PackageSeeder::class,
            CoachSeeder::class,
            SliderSeeder::class,
            // ProductSeeder::class,
            SettingSeeder::class,
            TermsTableSeeder::class,
            WebsiteSeeder::class,
            TraineeSeeder::class,
            TraineeProfileSeeder::class,
            FoodSeeder::class,
            MealSeeder::class,
        ]);
    }
}
