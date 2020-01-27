<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryImage extends Model
{
    protected $fillable = [
        'category_id',
        'image',
        'thumbnail_files',
        'alt',
        'sort_order'
    ];
}
