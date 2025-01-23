<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number',
        'category_id',
        'club_id',
        'price',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
