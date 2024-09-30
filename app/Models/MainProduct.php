<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'country',
        'size',
        'thickness',
        'metal_type',
        'units_per_package',
        'units_per_meter',
        'length',
        'weight_per_meter',
    ];
    public function product()
    {
        return $this->hasOne(Product::class, 'main_product_id');
    }
}
