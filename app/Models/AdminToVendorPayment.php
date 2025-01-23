<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminToVendorPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'vendor_id',
        'amount',
        'currency'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
