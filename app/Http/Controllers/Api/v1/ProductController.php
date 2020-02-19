<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @OA\Get(
     *     path="/products",
     *     operationId="products",
     *     tags={"products"},
     *     summary="Get list of categories with relation data",
     *     @OA\Parameter(
     *          name="category_id",
     *          in="query",
     *          required=false,
     *          description="The category id specific products category",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="perpage",
     *          in="query",
     *          required=true,
     *          description="Products per page",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
     *          description="Products page number",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="products",
     *                      description="Products list and pagination parameters",
     *                      @OA\Property(
     *                          property="current_page",
     *                          type="integer",
     *                          description="Current page number"
     *                      ),
     *                      @OA\Property(
     *                          property="data",
     *                          type="array",
     *                          description="Products array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                                  property="id",
     *                                  type="integer",
     *                                  description="Product ID"
     *                              ),
     *                              @OA\Property(
     *                                  property="name",
     *                                  type="string",
     *                                  description="Product name"
     *                              ),
     *                              @OA\Property(
     *                                  property="category_id",
     *                                  type="integer",
     *                                  description="Product category ID"
     *                              ),
     *                              @OA\Property(
     *                                  property="image_folder",
     *                                  type="string",
     *                                  description="Product image folder url"
     *                              ),
     *                              @OA\Property(
     *                                  property="unit_id",
     *                                  type="integer",
     *                                  description="Product unit ID"
     *                              ),
     *                              @OA\Property(
     *                                  property="sort_order",
     *                                  type="integer",
     *                                  description="Sort product value",
     *                              ),
     *                              @OA\Property(
     *                                  property="category",
     *                                  description="Specified product category",
     *                                  @OA\Property(
     *                                      property="id",
     *                                      type="integer",
     *                                      description="Specified product category id"
     *                                  ),
     *                                  @OA\Property(
     *                                      property="parent_id",
     *                                      type="integer",
     *                                      description="Specified parent category id"
     *                                  ),
     *                                  @OA\Property(
     *                                      property="name",
     *                                      type="string",
     *                                      description="Specified product category name"
     *                                  ),
     *                              ),
     *                              @OA\Property(
     *                                  property="product_images",
     *                                  type="array",
     *                                  description="Specified product images",
     *                                  @OA\Items(
     *                                      @OA\Property(
     *                                          property="id",
     *                                          type="integer",
     *                                          description="Specified product category id"
     *                                      ),
     *                                      @OA\Property(
     *                                          property="parent_id",
     *                                          type="integer",
     *                                          description="Specified parent category id"
     *                                      ),
     *                                      @OA\Property(
     *                                          property="name",
     *                                          type="string",
     *                                          description="Specified product category name"
     *                                      ),
     *                                      @OA\Property(
     *                                          property="alt",
     *                                          type="string",
     *                                          description="Specified product alternative name"
     *                                      ),
     *                                  ),
     *                              ),
     *                              @OA\Property(
     *                                  property="unit",
     *                                  description="Product unit",
     *                                  @OA\Property(
     *                                      property="id",
     *                                      type="integer",
     *                                      description="Prodict unit ID"
     *                                  ),
     *                                  @OA\Property(
     *                                      property="name",
     *                                      type="string",
     *                                      description="Prodict unit name"
     *                                  ),
     *                              ),
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                          property="last_page",
     *                          type="integer",
     *                          description="Last page number"
     *                      ),
     *                      @OA\Property(
     *                          property="path",
     *                          type="string",
     *                          description="Url to current path"
     *                      ),
     *                      @OA\Property(
     *                          property="per_page",
     *                          type="string",
     *                          description="Products per page"
     *                      ),
     *                      @OA\Property(
     *                          property="total",
     *                          type="integer",
     *                          description="Total products number"
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    /**
     * Method index per page and consider category
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = collect($this->productRepository->getProducts($request))
            ->forget(['first_page_url', 'last_page_url', 'next_page_url', 'prev_page_url']);
        return response(['products' => $products]);
    }

    /**
     * Get products by ids
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getByIds(Request $request)
    {
        $products = collect($this->productRepository->getProductsByIds($request->all()));
        return response(['products' => $products]);
    }
}