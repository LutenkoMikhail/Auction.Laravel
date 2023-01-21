<?php

namespace App\Http\Controllers;

use App\Actions\Lot\LotSearchAction;
use App\Http\Requests\SearchCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

class LotSearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SearchCategoryRequest $request
     * @param LotSearchAction $action
     * @return JsonResponse
     */
    public function __invoke(SearchCategoryRequest $request, LotSearchAction $action)
    {
        $success = false;
        $html = '';

        if ($request->ajax()) {
            if ($request->has('category')) {
                $html = $action->execute($request, Config::get('constants.db.paginate_lots.paginate_lot_9'));
                $success = true;
            }
        }

        return response()->json(array('success' => $success, 'html' => $html));
    }
}
