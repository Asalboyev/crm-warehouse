<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'user_id',
        'total_price',
        'total_weight',
        'status',
    ];


    // Define the relationship with OrderProduct
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // Define the relationship with the User (who created the order)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Client (who placed the order)
    public function client()
    {
        return $this->belongsTo(Customer::class);
    }

}
