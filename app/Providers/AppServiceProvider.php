<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('lots')) {
            view()->share('allLots',Lot::get()->count());
        }
        if (Schema::hasTable('categories')) {
            view()->share('allCategories', Category::get()->count());
        }
    }
}
