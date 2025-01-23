<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'type',
        'value',
        'start_date',
        'end_date',
        'is_active',
        'owner_type',
        'owner_id',
        "category_id",
        "product_id",
        "type_category_id",
        'applicable_scope',
        'category_product_id',
        'start_time',
        'end_time',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function typeCategory()
    {
        return $this->belongsTo(TypeCategory::class);
    }
    public function category_product()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
