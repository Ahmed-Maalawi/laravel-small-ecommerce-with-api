<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory, CascadesDeletes;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $cascadeDeletes = ['products'];

    protected $fillable = [
        'category_name', 'parent_category_id'
    ];

    public function parent()
    {
        return $this->belongsTo(category::class, 'parent_category_id');
    }

    public function children()
    {
        return $this->hasMany(category::class, 'parent_category_id');
    }

    // recursive, loads all descendants
    public function sub_category()
    {
        return $this->children()->with('sub_category');
    }

    public function products()
    {
        return $this->hasMany(product::class);
    }

    public function variation()
    {
        return $this->hasMany(variation::class);
    }
}
