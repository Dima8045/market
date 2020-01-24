<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Services\ImageService;

class CategoryController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $model)
    {
        return view('categories.index', [
            'categories' => $model->with('categoryImages')->paginate(15),
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
    public function store(CreateCategoryRequest $request, Category $model)
    {
        $result = $model->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? null,
        ]);
        if ($request->has('image')){
            $file = $request->file('image');
            $fileName = $this->imageService->upload($file, $request->name);
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
        //
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
