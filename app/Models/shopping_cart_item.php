<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_cart_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty', 'product_item_id', 'cart_id'
    ];

    public function UserShoppingCart()
    {
        return $this->belongsTo(shopping_cart::class);
    }

    public function ProductItem()
    {
        return $this->belongsTo(product_item::class);
    }
}
