<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'photo_path'];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

