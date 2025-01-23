<?php

namespace App\Models;

use App\Models\Coaching\Coach;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'video', 'iframe', 'category_id', 'coach_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function trainees()
    {
        return $this->belongsToMany(Trainee::class, 'training_trainee', 'training_id', 'trainee_id');
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

}
