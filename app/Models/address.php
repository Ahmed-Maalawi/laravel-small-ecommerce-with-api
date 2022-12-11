<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_type', 'phone_number', 'address_description',
    ];

    public function user()
    {
        return $this->hasMany(user_address::class);
    }
}
