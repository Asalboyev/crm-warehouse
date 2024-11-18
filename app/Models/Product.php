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

    protected $casts = [
        'thickness' => 'double',
        'length' => 'double',
        'price_per_ton' => 'double',
        'length_per_ton' => 'double',
        'price_per_meter' => 'double',
        'price_per_item' => 'double',
        'price_per_package' => 'double',
        'items_per_package' => 'double',
        'package_weight' => 'double',
        'package_length' => 'double',
        'weight_per_item' => 'double',
        'weight_per_meter' => 'double',
        'bron_package' => 'double',
        'bron_one_pc' => 'double',
        'grains_package' => 'double',
        'total_packages' => 'integer',
        'total_units' => 'integer',
        'items_in_package' => 'double',
        'total_weight' => 'double',
    ];
//    protected $casts = [
//        'price_per_ton' => 'decimal:2', // This will ensure it always has two decimal places.
//    ];
    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }



//    public function getPricePerTonAttribute($value)
//    {
//        // Always return with two decimals
//        return number_format($value, 2, '.', '');
//    }
    // Custom accessor to ensure correct format
//    public function getPricePerTonAttribute($value)
//    {
//        return round((float) $value, 2);
//    }


    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'main_product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
