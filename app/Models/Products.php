<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_id', 'name', 'brand', 'category_id', 'price',
        'size', 'size_unit', 'ingredients', 'key_ingredients',
        'image_url', 'source', 'collected_date',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class , 'category_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class , 'product_id', 'product_id');
    }

}
