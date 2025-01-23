<?php

namespace App\Models;

use App\Models\Coaching\Coach;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vitamin extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' , 'img' , 'desc' , 'price', 'coach_id' ];


    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

}
