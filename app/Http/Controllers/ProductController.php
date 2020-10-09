<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\StrHelper;
use App\Http\Requests\CreateProductRequest;
use App\Http\Services\ImageService;
use App\Repositories\CategoryRepository;
use App\Unit;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;
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
     * @param ImageService $imageService
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ImageService $imageService,
        CategoryRepository $categoryRepository
    )
    {
        $this->imageService = $imageService;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource case category.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getCategories($request);
        $products = $this->productRepository->getProducts($request);
        return view('products.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id', 'name']);
        $units = Unit::get(['id','name', 'description']);
        return view('products.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $category = Category::find($request->category_id)->image_folder;
        $folder = $request->has('image') ? StrHelper::rebuildFolderFormat('products' . '/' . $category . '/' . $request->name) : null;
        $result = $this->productRepository->create($request, $folder);
        if ($request->has('image')){
            $files = $request->file('image');
            foreach ($files as $file) {
                $fileName = $this->imageService->upload($file, $folder);
                $result->productImages()->create([
                    'image' => $fileName ?? null,
                    'alt' => $request->alt ?? null,
                ]);
            }
        }

        return redirect(route('products.index'))->withStatus(__('Product successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
