<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\StrHelper;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use App\Services\ImageService;
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
        $folder = StrHelper::rebuildFolderFormat($request->name);

        $result = $this->categoryRepository->create($request, $folder);

        return redirect(route('categories.index'))
            ->withStatus(__($result ? 'Category successfully created.' : 'Category wasn\'t created.'));
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
