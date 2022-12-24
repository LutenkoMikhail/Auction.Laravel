<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCategoryRequest;
use App\Http\Requests\StoreLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Models\Category;
use App\Models\Lot;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class LotController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('lot.index', [
            'lots' => Lot::allLots(Config::get('constants.db.paginate_lots.paginate_lot_9')),
            'categories' => Category::fullCategories(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('lot.create', [
            'categories' => Category::fullCategories(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLotRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLotRequest $request)
    {
        return redirect()->route('lots.index')->with('message', Lot::newLot($request));
    }


    /**
     * Display the specified resource.
     *
     * @param Lot $lot
     * @return Application|Factory|View
     */
    public function show(Lot $lot)
    {
        return view('lot.show', [
            'lot' => Lot::oneLot($lot)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Lot $lot
     * @return Application|Factory|View
     */
    public function edit(Lot $lot)
    {
        return view('lot.edit',
            [
                'lot' => $lot,
                'categories' => Category::fullCategories(),
            ]
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLotRequest $request
     * @param Lot $lot
     * @return RedirectResponse
     */
    public function update(UpdateLotRequest $request, Lot $lot)
    {
        return redirect()->route('lots.index')->with('message', Lot::updateLot($request, $lot));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Lot $lot
     * @return RedirectResponse
     */
    public function destroy(Lot $lot)
    {
        return redirect()->route('lots.index')->with('message', Lot::destroyLot($lot));
    }

    /**
     * Search the specified resource
     *
     * @param SearchCategoryRequest $request
     * @return JsonResponse
     */
    public function search(SearchCategoryRequest $request)
    {
        $success = false;
        $html = '';

        if ($request->ajax()) {
            if ($request->has('category')) {
                $html = view('lot.ajax.card', [
                    'lots' => Lot::searchLot($request->input('category'),
                        Config::get('constants.db.paginate_lots.paginate_lot_9'))
                ])->render();
                $success = true;
            }
        }

        return response()->json(array('success' => $success, 'html' => $html));
    }
}
