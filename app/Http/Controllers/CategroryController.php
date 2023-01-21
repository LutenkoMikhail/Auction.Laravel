<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use App\Services\Lot\LotService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class CategroryController extends Controller
{

    /**
     * Service Object type CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * Сonstructor
     *
     * @param LotService $lotService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('category.index', [
            'categories' => $this->categoryService->allCategories(Config::get('constants.db.paginate_categories.paginate_category_6'))
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('category.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        return redirect()->route('categories.index')->with('message', $this->categoryService->newCategory($request));
    }


    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category)
    {
        return view('category.show', [
            'category' => $this->categoryService->oneCategory($category)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        return view('category.edit',
            [
                'category' => $category,
            ]
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return redirect()->route('categories.index')->with('message', $this->categoryService->updateCategory($request, $category));
    }


    /**
     *  Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        return redirect()->route('categories.index')->with('message', $this->categoryService->destroyCategory($category));
    }

}
