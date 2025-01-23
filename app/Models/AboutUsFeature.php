<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsFeature extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rate',
        'about_us_id',
    ];


    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class);
    }
}
