<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscribable_id',
        'subscribable_type',
        'amount',
        'package_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function subscribable()
    {
        return $this->morphTo();
    }
}
