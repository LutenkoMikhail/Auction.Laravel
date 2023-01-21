<?php

namespace App\Actions\Lot;

use App\Http\Requests\SearchCategoryRequest;
use App\Services\Lot\LotService;

class LotSearchAction
{

    /**
     * Service Object type LotService
     */
    protected LotService $lotService;

    /**
     * Сonstructor
     *
     * @param LotService $lotService
     */
    public function __construct(LotService $lotService)
    {
        $this->lotService = $lotService;
    }

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
            'lots' => $this->lotService->searchLot($request->input('category'), $paginate)
        ])->render();
    }
}
