<?php

namespace App\Http\Controllers\Api;

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
     * @param CategoryRepository $catRepo
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * @OA\Get(
     *      path="/categories",
     *      operationId="get_categories",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      security={
     *         {"bearerAuth": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Category")
     *         )
     *       )
     *     )
     */
     /**
     * Returns list of categories
     */
    public function index()
    {
        return response($this->categoryRepository->get());
    }
}
