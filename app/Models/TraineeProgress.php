<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id',
        'img',
        'upload_date',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
