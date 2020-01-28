<?php


namespace App\Repositories;

use App\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends BaseRepository
{
    /**
     * @var Product
     */
    private $model;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Custom method get()
     *
     * @return object
     */
    public function get() :object
    {
        return $this->joiningPaths($this->model->with('productImages')->get());
    }

    /**
     * Custom method create()
     *
     * @param object $request
     * @param string $folder
     * @return mixed
     */
    public function create(object $request, string $folder) :object
    {
        return $this->model->create([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'alt' => $request->alt ?? null,
            'image_folder' => $folder,
        ]);
    }

}