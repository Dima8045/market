<?php

namespace App\Http\Controllers\Api\v1;

use App\Category;
use App\Repositories\CategoryRepository;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @OA\Get(
     *     path="/categories/list",
     *     operationId="categoriesList",
     *     tags={"Categories"},
     *     summary="Get list of categories",
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *              @OA\JsonContent(
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          description="Category Id"
     *                      ),
     *                      @OA\Property(
     *                          property="parent_id",
     *                          type="integer",
     *                          description="Parent category Id",
     *                          default="null"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          description="Name of category"
     *                      ),
     *                      @OA\Property(
     *                          property="image_folder",
     *                          type="string",
     *                          description="Category images folder name"
     *                      ),
     *                      @OA\Property(
     *                          property="created_at",
     *                          type="string",
     *                          description="timestamp of creating",
     *                          example="2018-10-16 10:54:44"
     *                      ),
     *                      @OA\Property(
     *                          property="updated_at",
     *                          type="string",
     *                          description="timestamp of last updated",
     *                          example="2018-10-16 10:54:44"
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     */


    /**
     * Returns list of categories
     */
    public function list()
    {
        return response(['categories' => Category::get()]);
    }

    /**
     * @OA\Get(
     *     path="/categories",
     *     operationId="categories",
     *     tags={"Categories"},
     *     summary="Get list of categories with relation data",
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *              @OA\JsonContent(
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          description="Category Id"
     *                      ),
     *                      @OA\Property(
     *                          property="parent_id",
     *                          type="integer",
     *                          description="Parent category Id",
     *                          default="null"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          description="Name of category"
     *                      ),
     *                      @OA\Property(
     *                          property="image_folder",
     *                          type="string",
     *                          description="Category images folder name"
     *                      ),
     *                      @OA\Property(
     *                          property="categoryImages",
     *                          type="array",
     *                          description="Category images collection",
     *                          @OA\Items(
     *                              @OA\Property(
     *                                  property="id",
     *                                  type="integer",
     *                              ),
     *                              @OA\Property(
     *                                  property="category_id",
     *                                  type="integer",
     *                              ),
     *                              @OA\Property(
     *                                  property="image",
     *                                  type="string",
     *                              ),
     *                              @OA\Property(
     *                                  property="alt",
     *                                  type="integer",
     *                              ),
     *                              @OA\Property(
     *                                  property="sort_order",
     *                                  type="integer",
     *                              ),
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     */
    /**
     * Get categories with relations
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->categoryRepository->list());
    }
}
