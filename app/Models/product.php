<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'product_image', 'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function productItems()
    {
        return $this->hasMany(product_item::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(wishlist::class);
    }
}
