<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminToClubPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'club_id',
        'amount',
        'currency'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
