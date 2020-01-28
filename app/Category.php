<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category model",
 * )
 */
class Category extends Model
{
    /**
     * Categories per page
     */
    const CATEGORIES_PAGE=10;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'image_folder',
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     type="integer",
     *     description="Category Id"
     * ),
     * @OA\Property(
     *     property="parent_id",
     *     type="integer",
     *     description="Parent category Id",
     *     default="null"
     * )
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     description="Name of category"
     * )
     * @OA\Property(
     *     property="image_folder",
     *     type="string",
     *     description="Category images folder name"
     * )
     * @OA\Property(
     *     property="created_at",
     *     type="string",
     *     description="timestamp of creating",
     *     example="2018-10-16 10:54:44"
     * )
     * @OA\Property(
     *     property="updated_at",
     *     type="string",
     *     description="timestamp of last updated",
     *     example="2018-10-16 10:54:44"
     * )
     * @OA\Property(
     *     property="categoryImages",
     *     type="array",
     *     description="Category images collection",
     *     @OA\Items(
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *         ),
     *         @OA\Property(
     *             property="category_id",
     *             type="integer",
     *         ),
     *         @OA\Property(
     *             property="image",
     *             type="string",
     *         ),
     *         @OA\Property(
     *             property="alt",
     *             type="integer",
     *         ),
     *         @OA\Property(
     *             property="sort_order",
     *             type="integer",
     *         ),
     *         @OA\Property(
     *             property="created_at",
     *             type="string",
     *             description="timestamp of creating",
     *             example="2018-10-16 10:54:44"
     *         ),
     *         @OA\Property(
     *             property="updated_at",
     *             type="string",
     *             description="timestamp of last updated",
     *             example="2018-10-16 10:54:44"
     *         )
     *     )
     * )
     */

    public function categoryImages()
    {
        return $this->hasMany(CategoryImage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
