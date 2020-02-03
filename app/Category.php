<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * Categories per admin page
     */
    const CATEGORIES_ADMIN_PAGE=10;

    /**
     * Categories per client page
     */
    const CATEGORIES_CLIENT_PAGE=10;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'image_folder',
    ];

    public function categoryImages()
    {
        return $this->hasMany(CategoryImage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
