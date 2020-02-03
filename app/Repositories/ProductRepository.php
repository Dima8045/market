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
     * Method getProducts per page and consider category
     *
     * @param $request
     * @return object
     */
    public function getProducts($request) :object
    {
        $products = $this->model;
        if ($request->has('category')) {
            $products = $this->model->where('category_id', $request->category);
        }
        $products = $products->select(
            'id', 'name', 'category_id', 'image_folder', 'unit_id', 'sort_order'
        )
            ->with(['category' => function($query) {
                $query->select('id', 'parent_id', 'name');
            }])
            ->with(['productImages' => function($query) {
                $query->select('id', 'product_id', 'image', 'alt');
            }])
            ->with(['unit'=>function($query){
                $query->select('id', 'name');
            }])
            ->paginate(
                $request->input('perpage'),
                '*',
                'page',
                $request->input('page')
            );
        return $this->joiningPaths($products);
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