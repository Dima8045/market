<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Products per admin page
     */
    const PRODUCTS_ADMIN_PAGE=15;

    /**
     * Products per client page
     */
    const PRODUCTS_CLIENT_PAGE=12;

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

    public $excludeColumns = [
        'unit_id'
    ];

    public function scopeExclude($query,$value = array())
    {
        return $query->select( array_intersect( $this->excludeColumns,(array) $value) );
    }

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
