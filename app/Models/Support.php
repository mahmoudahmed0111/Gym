<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = ['owner_type', 'owner_id', 'message'];

    public function owner()
    {
        return $this->morphTo();
    }
}
