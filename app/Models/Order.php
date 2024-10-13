<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'client_id',
        'total_price',
        'total_weight',
        'status',
        'car_number',
        'zayafka    '
    ];


    // Define the relationship with OrderProduct
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function user() // Who sold the product
    {
        return $this->belongsTo(User::class);
    }

    public function client() // To whom it was sold
    {
        return $this->belongsTo(Customer::class, 'client_id');
    }



    // Define the relationship with the Client (who placed the order)


}
