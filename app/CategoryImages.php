<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryImages extends Model
{
    protected $fillable = [
        'category_id',
        'name_files',
        'path',
        'thumbnail_files',
        'thumbnail_path',
        'alt',
        'sort_order'
    ];
}
