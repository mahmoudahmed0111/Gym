<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id', 'coach_id', 'age', 'gender', 'status', 'weight', 'height', 'bmi',
        'body_fat_percentage', 'body_water_percentage', 'muscle_mass',
        'resting_heart_rate', 'blood_pressure', 'health_conditions',
        'membership_start_date', 'membership_end_date'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }


    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }





}
