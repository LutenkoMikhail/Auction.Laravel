<?php

use App\Http\Controllers\CategroryController;
use App\Http\Controllers\LotController;
use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\LotController@index')->name('index');
Route::resource('lots', LotController::class);
Route::resource('categories', CategroryController::class);
