<?php

namespace Database\Seeders;

use App\Models\Trainee;
use App\Models\Coaching\Coach;
use App\Models\TraineeProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TraineeProfileSeeder extends Seeder
{
    /**
     * Seed the trainee profiles table.
     *
     * @return void
     */
    public function run()
    {
        // Get the coach ID, assuming there is at least one coach in the database
        $coach = Coach::first(); // Ensure this returns the correct coach
        $coachId = $coach ? $coach->id : 1; // Default to 1 if no coach is found
        // $trainee = Trainee::first(); // Retrieve an existing trainee
        // $coachId = $trainee ? $trainee->coach_id : 1; // Use the coach_id from the trainee

        // Clear the table before seeding
        TraineeProfile::truncate();

        // Array of static data
        $traineeProfiles = [
            [

                'trainee_id' => 1,
                'coach_id' => $coachId,
                'age' => 25,
                'weight' => 70,
                'height' => 175,
                'bmi' => $this->calculateBmi(70, 175),
                'body_fat_percentage' => 15,
                'body_water_percentage' => 60,
                'muscle_mass' => 30,
                'resting_heart_rate' => 60,
                'blood_pressure' => '120/80',
                'health_conditions' => 'None',
                'membership_start_date' => now()->subMonths(1),
                'membership_end_date' => now()->addMonths(11),
                'gender' => 'Male',
                'status' => 'Active',
            ],
            [
                'trainee_id' => 1,
                'coach_id' => $coachId,
                'age' => 30,
                'weight' => 80,
                'height' => 180,
                'bmi' => $this->calculateBmi(80, 180),
                'body_fat_percentage' => 20,
                'body_water_percentage' => 55,
                'muscle_mass' => 35,
                'resting_heart_rate' => 65,
                'blood_pressure' => '130/85',
                'health_conditions' => 'Asthma',
                'membership_start_date' => now()->subMonths(2),
                'membership_end_date' => now()->addMonths(10),
                'gender' => 'Female',
                'status' => 'Inactive',
            ],
            // Add more static data as needed
        ];

        // Insert data into the trainee_profiles table
        foreach ($traineeProfiles as $profile) {
            TraineeProfile::create($profile);
        }
    }

    /**
     * Calculate BMI.
     *
     * @param float $weight
     * @param float $height
     * @return float
     */
    private function calculateBmi($weight, $height)
    {
        // Height in meters
        $heightInMeters = $height / 100;
        // Calculate BMI
        return round($weight / ($heightInMeters * $heightInMeters), 1);
    }
}
