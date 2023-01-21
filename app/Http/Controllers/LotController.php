<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Models\Lot;
use App\Services\Category\CategoryService;
use App\Services\Lot\LotService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class LotController extends Controller
{
    /**
     * Service Object type LotService
     */
    protected LotService $lotService;

    /**
     * Service Object type CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * Сonstructor
     *
     * @param LotService $lotService
     */
    public function __construct(LotService $lotService,CategoryService $categoryService)
    {
        $this->lotService = $lotService;
        $this->categoryService = $categoryService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('lot.index', [
            'lots' => $this->lotService->allLots(Config::get('constants.db.paginate_lots.paginate_lot_9')),
            'categories' => $this->categoryService->fullCategories(),
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
            'categories' =>  $this->categoryService->fullCategories(),
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
        return redirect()->route('lots.index')->with('message', $this->lotService->newLot($request));
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
            'lot' => $this->lotService->oneLot($lot)
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
                'categories' => $this->categoryService->fullCategories(),
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
        return redirect()->route('lots.index')->with('message', $this->lotService->updateLot($request, $lot));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Lot $lot
     * @return RedirectResponse
     */
    public function destroy(Lot $lot)
    {
        return redirect()->route('lots.index')->with('message', $this->lotService->destroyLot($lot));
    }

}
