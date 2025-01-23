<?php

namespace App\Models;

use App\Models\Coaching\Coach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' , 'img' , 'amount' , 'fat', 'carbohydrate', 'protein', 'coach_id' ];


    public function trainer()
    {
        return $this->belongsTo(Coach::class);
    }

    public function trainees()
    {
        return $this->belongsToMany(Trainee::class, 'trainee_food');
    }

}
