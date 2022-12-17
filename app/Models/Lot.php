<?php

namespace App\Models;

use App\Http\Requests\StoreLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Http\Traits\ModelPaginateTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lot extends Model
{
    use HasFactory, ModelPaginateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];


    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }


    /**
     * @return false|int
     */
    public function checkCategories()
    {
        $categories = $this->categories()->count();

        if ($categories !== 0) {
            return $categories;
        } else {
            return false;
        }

    }

    /**
     * @param $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    static public function allLots($paginate)
    {
        Lot::$paginate = $paginate;

        return Lot::with('categories')->orderBy('id')->paginate(Lot::$paginate);
    }


    /**
     * @param Lot $lot
     * @return string
     */
    static public function destroyLot(Lot $lot)
    {
        $message = 'Delete Failed';

        if ($lot->delete() > 0) {
            $message = 'Successfully Deleted';
        }

        return $message;
    }

    /**
     * @param Lot $lot
     * @return Builder|Builder|Collection|Model|null
     */
    static public function oneLot(Lot $lot)
    {
        return Lot::with('categories.lots')->find($lot->id);
    }

    /**
     * @param StoreLotRequest $request
     * @return string
     */
    static public function newLot(StoreLotRequest $request)
    {
        $message = 'Creating lot Failed';

        $lot = new Lot([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($lot->save()) {
            $lot->categories()->attach($request->categories);
            $message = 'Lot created';
        }
        return $message;
    }

    /**
     * @param UpdateLotRequest $request
     * @param Lot $lot
     * @return string
     */
    static public function updateLot(UpdateLotRequest $request, Lot $lot)
    {
        $message = 'Update lot Failed';

        if ($lot->update($request->only('name', 'description'))) {
            if (!empty($request->categories)) {
                $lot->categories()->detach();
                $lot->categories()->attach($request->categories);
                $message = 'Update lot';
            }
        }

        return $message;
    }

}
