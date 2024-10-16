<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function subProduct()
    {
        return $this->hasManyThrough(Product::class, Category::class)->orderBy('id');
    }

}
