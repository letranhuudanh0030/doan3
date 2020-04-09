<?php

namespace App\Providers;

use App\Info;
use App\ProductCategory;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength('191');
        // product category
        // $categories = ProductCategory::where('publish', 1)->get();
        // $parent_cate = ProductCategory::where('publish', 1)->where('parent_id', 0)->first();
        // $categories_f = ProductCategory::where('publish', 1)->where('parent_id', $parent_cate->id)->get();

        // info
        // $info = Info::first();

        // View::share('categories', $categories);
        // view()->share([
        //     'categories' => $categories,
        //     'categories_f' => $categories_f,
        //     'info' => $info,
        //     ]);
    }
}
