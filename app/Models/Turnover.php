<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turnover extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'user_id', 'type', 'quantity_pack', 'quantity_piece', 'total_weight'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
