<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'category_id',
        'country',
        'thickness',
        'length',
        'metal_type',
        'price_per_ton',
        'length_per_ton',
        'price_per_meter',
        'price_per_item',
        'price_per_package',
        'items_per_package',
        'package_weight',
        'package_length',
        'weight_per_meter',
        'total_packages',
        'items_in_package',
        'total_weight',
        'weight_per_item',
        'total_units'
    ];
    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'main_product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
