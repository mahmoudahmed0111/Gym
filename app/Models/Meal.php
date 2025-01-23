<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' , 'desc' , 'amount' , 'fat', 'carbohydrate', 'protein', 'coach_id' ];


    public function trainees()
    {
        return $this->belongsToMany(Trainee::class, 'meal_trainee');
    }


}
