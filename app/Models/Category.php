<?php

namespace App\Models;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Traits\ModelPaginateTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, ModelPaginateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];


    /**
     * @return BelongsToMany
     */
    public function lots()
    {
        return $this->belongsToMany(Lot::class)->withTimestamps();
    }

    /**
     * @return bool
     */
    public function canDeleteCategory()
    {
        if ($this->lots->count() === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    static public function fullCategories()
    {
        return Category::orderBy('id')->get();
    }

    /**
     * @param $paginate
     * @return LengthAwarePaginator
     */
    static public function allCategories($paginate)
    {
        Category::$paginate = $paginate;

        return Category::with('lots')->orderBy('id')->paginate(Category::$paginate);
    }

    /**
     * @param Lot $lot
     * @return string
     */
    static public function destroyCategory(Category $category)
    {
        $message = 'Delete Failed';

        if ($category->canDeleteCategory()) {
            if ($category->delete() > 0) {
                $message = 'Successfully Deleted';
            }
        }

        return $message;
    }

    /**
     * @param Category $category
     * @return Builder|Builder|Collection|Model|null
     */
    static public function oneCategory(Category $category)
    {
        return Category::with('lots.categories')->find($category->id);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return string
     */
    static public function newCategory(StoreCategoryRequest $request)
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
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return string
     */
    static public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        $message = 'Update category Failed';

        if ($category->update($request->only('name'))) {
            $message = 'Update category';
        }

        return $message;
    }

}
