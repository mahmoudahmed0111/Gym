<?php

namespace App\Models;

use App\Models\Coaching\Coach;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email' , 'email_verified_at', 'password', 'mobile' , 'img', 'is_active',
        'category_id', 'package_id', 'coach_id', 'lat', 'lng', 'location'
    ];

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_trainee');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function profile()
    {
        return $this->hasOne(TraineeProfile::class, 'trainee_id');
    }

    // public function foods()
    // {
    //     return $this->hasMany(Food::class);
    // }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_trainee', 'trainee_id', 'meal_id');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_trainee', 'training_id', 'trainee_id');
    }



    protected static function booted()
    {


        static::created(function ($trainee) {

            try{

                $coach = auth('coach')->user();

                if ($coach) {
                    TraineeProfile::create([
                        'trainee_id' => $trainee->id,
                        'coach_id' => $coach->id,
                        'age' => $trainee->age ?? null,
                        'gender' => $trainee->gender ?? null,
                        'status' => $trainee->status ?? 'Active',
                        'weight' => $trainee->weight ?? null,
                        'height' => $trainee->height ?? null,
                        'bmi' => $trainee->calculateBmi($trainee->weight, $trainee->height),
                        'body_fat_percentage' => $trainee->body_fat_percentage ?? null,
                        'body_water_percentage' => $trainee->body_water_percentage ?? null,
                        'muscle_mass' => $trainee->muscle_mass ?? null,
                        'resting_heart_rate' => $trainee->resting_heart_rate ?? null,
                        'blood_pressure' => $trainee->blood_pressure ?? null,
                        'health_conditions' => $trainee->health_conditions ?? null,
                        'membership_start_date' => now(),
                        'membership_end_date' => null,
                    ]);
                } else {
                    // Handle the case where no coach is authenticated
                    \Log::error('No coach is authenticated.');
                    // Or assign a default coach if applicable
                }

            }catch (\Exception $e) {
                \Log::error('Error creating TraineeProfile:', ['error' => $e->getMessage()]);
            }





            // Check if the coach is authenticated


        });
    }
    // Example function to calculate BMI
    function calculateBmi($weight, $height)
    {
        if ($weight && $height) {
            $heightInMeters = $height / 100; // Assuming height is in cm
            return round($weight / ($heightInMeters * $heightInMeters), 1);
        }
        return null;
    }





}
