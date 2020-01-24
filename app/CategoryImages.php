<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryImages extends Model
{
    protected $fillable = [
        'category_id',
        'image',
        'thumbnail_files',
        'alt',
        'sort_order'
    ];
}
