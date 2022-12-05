<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variation_option extends Model
{
    use HasFactory;

    public function variation()
    {
        return $this->belongsTo(variation::class);
    }

    public function productConfiguration()
    {
        return $this->hasMany(product_configuration::class);
    }
}
