<?php


namespace App\Repositories;

use App\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
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
     * Custom method get()
     *
     * @return object
     */
    public function get() :object
    {
        return $this->joiningPaths($this->model->with('categoryImages')->get());
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

    public function joiningPaths($categories) :object
    {
        return $categories->map(function ($cat) {
            $cat->image_folder = asset('storage') . '/' .$cat->image_folder;
            return $cat;
        });
    }

}