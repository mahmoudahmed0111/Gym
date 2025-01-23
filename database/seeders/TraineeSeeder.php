<?php

namespace Database\Seeders;

use App\Models\Trainee;
use App\Models\Coaching\Coach;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TraineeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coach = Coach::firstOrCreate(
            ['email' => 'coach@yahoo.com'],
            [
                'name' => 'Default Coach',
                'password' => Hash::make('password'),
                'mobile' => '0123456789', // Add the mobile number
                // Add other necessary fields if required
            ]
        );

        $coachId = $coach->id;

        // Check if the email already exists
        $trainee=Trainee::create([
            'name' => 'mohamed',
            'email' => 'trainee1@yahoo.com',
            'mobile' => '1234567890',
            'password' => Hash::make('password'),
            'img' => 'path/to/image.jpg',
            'is_active' => true,
            'category_id' => 1,
            'package_id' => 3,
            'coach_id' => $coachId,
            'lng' => 46.6753,
            'lat' => 24.7136,
            'created_at' => "12:00:00",
            'updated_at' => "23:00:00",
            'location' => 'Beni-suef, Egypt',

        ]);

        $trainee=Trainee::create([
            'name' => 'mahmoud',
            'email' => 'trainee1@gmail.com',
            'mobile' => '0111875',
            'password' => Hash::make('password'),
            'img' => 'path/to/image.jpg',
            'is_active' => true,
            'category_id' => 3,
            'package_id' => 2,
            'coach_id' => $coachId,
            'lng' => 46.6753,
            'lat' => 24.7136,
            'created_at' => "12:00:00",
            'updated_at' => "23:00:00",
            'location' => 'Beni-suef, Egypt',

        ]);



        $trainee=Trainee::create([
            'name' => 'zaky',
            'email' => 'trainee2@yahoo.com',
            'mobile' => '474575742',
            'password' => Hash::make('password'),
            'img' => 'path/to/image.jpg',
            'is_active' => true,
            'category_id' => 1,
            'package_id' => 3,
            'coach_id' => 2,
            'lng' => 46.6753,
            'lat' => 24.7136,
            'created_at' => "12:00:00",
            'updated_at' => "23:00:00",
            'location' => 'Beni-suef, Egypt',

        ]);

        $trainee=Trainee::create([
            'name' => 'zika',
            'email' => 'trainee2@gmail.com',
            'mobile' => '7276751',
            'password' => Hash::make('password'),
            'img' => 'path/to/image.jpg',
            'is_active' => true,
            'category_id' => 3,
            'package_id' => 2,
            'coach_id' => 2,
            'lng' => 46.6753,
            'lat' => 24.7136,
            'created_at' => "12:00:00",
            'updated_at' => "23:00:00",
            'location' => 'Beni-suef, Egypt',

        ]);
    }




    // $owner->syncRoles(['owners' => 1]);

    }
