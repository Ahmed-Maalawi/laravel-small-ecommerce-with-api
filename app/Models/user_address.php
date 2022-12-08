<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'address_id',
    ];


    public function address()
    {
        return $this->belongsTo(address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
