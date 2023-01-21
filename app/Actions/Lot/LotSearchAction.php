<?php

namespace App\Actions\Lot;

use App\Http\Requests\SearchCategoryRequest;
use App\Models\Lot;

class LotSearchAction
{
    /**
     * Search of the resource
     *
     * @param SearchCategoryRequest $request
     * @param $paginate
     * @return string
     */
    public function execute(SearchCategoryRequest $request, $paginate)
    {
        return view('lot.ajax.card', [
            'lots' => Lot::searchLot($request->input('category'), $paginate)
        ])->render();
    }
}
