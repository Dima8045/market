<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Products per page
     */
    const PRODUCTS_PAGE=15;

    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'unit_id',
        'price',
        'image_folder',
        'sort_order'
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
