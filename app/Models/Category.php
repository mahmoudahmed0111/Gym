<?php

namespace App\Models;

use App\Models\Coaching\Coach;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'image',
        'type',
    ];

    // public function clubs()
    // {
    //     return $this->hasMany(Club::class);
    // }



    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function trainingType()
    {
        return $this->hasMany(Training::class)->where('type', 'training');
    }

    public function trainees()
    {
        return $this->belongsToMany(Trainee::class, 'category_trainee');
    }

    public function traineeProfiles()
    {
        return $this->hasMany(TraineeProfile::class);
    }

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'category_coach');
    }



}
