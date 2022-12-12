<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'sku', 'qty_in_stock', 'product_image', 'price'
    ];

    public function Product()
    {
        return $this->belongsTo(product::class);
    }

    public function productConfiguration()
    {
        return $this->hasMany(product_configuration::class);
    }

    public function favoriteCartItems()
    {
        return $this->hasMany(favoriteCartItem::class);
    }
}
