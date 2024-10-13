<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';


    // Define the fillable properties
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity_pochka',
        'quantity_dona',
        'price_per_ton',
        'price_per_unit',
        'total_price',
        'total_weight',
        'times_sold',
        'is_returned',
    ];


    // Define the relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
