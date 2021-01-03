<?php


namespace App\Repositories;

use App\Category;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

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
     * Method getCategories per page and consider category
     *
     * @return object
     */
    public function getCategories($request) :object
    {
        $categories = $this->model;

        return $this->joiningPaths($categories->with( 'categoryImages')->paginate($request->input('perpage')));
    }


    /**
     * Method get category
     *
     * @param int $id
     * @return object
     */
    public function getCategory(int $id) :object
    {
        return $this->joiningPaths($this->model->where('id', $id)->with( 'categoryImages')->get());
    }

    /**
     * Custom method create()
     *
     * @param object $request
     * @param string $folder
     * @return mixed
     */
    public function create(object $request, string $folder) :bool
    {
        DB::beginTransaction();

        try {
            $category = $this->model->create([
                'name' => $request->name,
                'parent_id' => $request->parent_id ?? null,
                'image_folder' => $folder,
            ]);

            $file = $request->file('image');
            $fileName = ImageService::upload($file, $folder);
            $category->categoryImages()->create([
                'image' => $fileName ?? null,
                'alt' => $request->alt ?? null,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
