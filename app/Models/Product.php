<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'name',

        'slug',

        'category',

        'price',

        'image',

        'short_description',

        'description',

        'featured',

        'status'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}