<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'product_image'
    ];


    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
