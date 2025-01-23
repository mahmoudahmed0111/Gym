<?php

namespace App\Models;

use App\Http\Controllers\ClubDashboard\AboutUsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'video',
    ];


    public function features()
    {
        return $this->hasMany(AboutUsFeature::class);
    }
}
