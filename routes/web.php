<?php

use App\Http\Controllers\CategroryController;
use App\Http\Controllers\LotController;
use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\LotController@index')->name('index');

Route::post('search', 'App\Http\Controllers\LotController@search')->name('search');


Route::resource('lots', LotController::class)
    ->missing(function (Request $request) {
        return Redirect::route('lots.index');
    });

Route::resource('categories', CategroryController::class)
    ->missing(function (Request $request) {
        return Redirect::route('categories.index');
    });
