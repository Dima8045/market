<?php


namespace App\Repositories;

use App\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @var Category
     */
    private $model;

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Method list return resource with relation
     *
     * @return object
     */
    public function list() :object
    {
        $categories = $this->model
            ->select(['id', 'parent_id', 'image_folder', 'name'])
            ->with(['categoryImages' => function($query) {
                $query->select(['id', 'image', 'category_id', 'alt', 'sort_order']);
            }])->get();
        return $this->joiningPaths($categories);
    }


    /**
     * Method getCategory per page and consider category
     *
     * @return object
     */
    public function getCategory($request) :object
    {
        $categories = $this->model;
        if ($request->has('category')) {
            $categories = $this->model->where('id', $request->category);
        }
        return $this->joiningPaths($categories->with( 'categoryImages')->paginate($request->input('perpage')));
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
            'parent_id' => $request->parent_id ?? null,
            'image_folder' => $folder,
        ]);
    }
}