<?php

namespace App\Services\Lot;

use App\Http\Requests\StoreLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Models\Lot;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LotService
{
    /**
     * @param $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allLots($paginate)
    {
        Lot::$paginate = $paginate;

        return Lot::with('categories')->orderBy('id')->paginate(Lot::$paginate);
    }

    /**
     * @param StoreLotRequest $request
     * @return string
     */
    public function newLot(StoreLotRequest $request)
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
     * @param Lot $lot
     * @return Builder|Builder|Collection|Model|null
     */
    public function oneLot(Lot $lot)
    {
        return Lot::with('categories.lots')->find($lot->id);
    }


    /**
     * @param UpdateLotRequest $request
     * @param Lot $lot
     * @return string
     */
    public function updateLot(UpdateLotRequest $request, Lot $lot)
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

    /**
     * @param Lot $lot
     * @return string
     */
    public function destroyLot(Lot $lot)
    {
        $message = 'Delete Failed';

        if ($lot->delete() > 0) {
            $message = 'Successfully Deleted';
        }

        return $message;
    }

    /**
     * @param $categoryId
     * @param $paginate
     * @return mixed
     */
    static public function searchLot($categoryId, $paginate)
    {
        Lot::$paginate = $paginate;

        return Lot::when($categoryId, function (Builder $query, $categoryId) {
            return $query->whereHas('categories', function (Builder $query) use ($categoryId) {
                $query->whereIn('categories.id', $categoryId);
            });
        })->paginate(Lot::$paginate);
    }
}
