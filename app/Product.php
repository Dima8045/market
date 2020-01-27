<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'unit',
        'price',
        'image_folder',
        'sort_order'
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
