<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\StrHelper;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Services\ImageService;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param ImageService $imageService
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        ImageService $imageService,
        CategoryRepository $categoryRepository
    )
    {
        $this->imageService = $imageService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->merge(['perpage' => Category::CATEGORIES_ADMIN_PAGE]);
        return view('categories.index', [
            'categories' => $this->categoryRepository->getCategories($request),
        ]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $model)
    {
        return view('categories.create', ['categories' => $model->get(['id', 'name'])]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $folder = $request->has('image') ? StrHelper::rebuildFolderFormat($request->name) : null;

        $result = $this->categoryRepository->create($request, $folder);
        if ($request->has('image')){
            $file = $request->file('image');
            $fileName = $this->imageService->upload($file, $folder);
            $result->categoryImages()->create([
                'image' => $fileName ?? null,
                'alt' => $request->alt ?? null,
            ]);
        }

        return redirect(route('categories.index'))->withStatus(__('Category successfully created.'));
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getCategory($id)->first();
        $categories = $this->categoryRepository->list()->whereNotIn('id', [$id]);

        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified category in storage.
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
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
