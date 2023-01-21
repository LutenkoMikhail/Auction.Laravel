<?php

namespace App\Services\Category;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Lot;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    /**
     * @return mixed
     */
    public function fullCategories()
    {
        return Category::orderBy('id')->get();
    }

    /**
     * @param $paginate
     * @return LengthAwarePaginator
     */
    public function allCategories($paginate)
    {
        Category::$paginate = $paginate;

        return Category::with('lots')->orderBy('id')->paginate(Category::$paginate);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return string
     */
    public function newCategory(StoreCategoryRequest $request)
    {
        $message = 'Creating category Failed';

        $category = new Category([
            'name' => $request->name,
        ]);

        if ($category->save()) {
            $message = 'Category created';
        }

        return $message;
    }

    /**
     * @param Category $category
     * @return Builder|Builder|Collection|Model|null
     */
    public function oneCategory(Category $category)
    {
        return Category::with('lots.categories')->find($category->id);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return string
     */
    public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        $message = 'Update category Failed';

        if ($category->update($request->only('name'))) {
            $message = 'Update category';
        }

        return $message;
    }

    /**
     * @param Lot $lot
     * @return string
     */
    public function destroyCategory(Category $category)
    {
        $message = 'Delete Failed';

        if ($category->canDeleteCategory()) {
            if ($category->delete() > 0) {
                $message = 'Successfully Deleted';
            }
        }

        return $message;
    }
}
