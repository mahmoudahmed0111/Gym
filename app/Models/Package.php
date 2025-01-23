<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'price',
        'time',
    ];

    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }

    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }


    public function traineeProfiles()
    {
        return $this->hasMany(TraineeProfile::class);
    }

}
