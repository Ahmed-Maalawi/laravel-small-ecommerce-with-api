<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_configuration extends Model
{
    use HasFactory;

    protected $fillable = [
      'product_item_id', 'variation_option_id'
    ];

    public function productItem()
    {
        return $this->belongsTo(product_item::class);
    }

    public function variationOptoin()
    {
        return $this->belongsTo(variatio_option::class);
    }
}
