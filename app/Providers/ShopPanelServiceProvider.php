<?php

namespace App\Providers;

use App\Site;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ShopPanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('shop_panel.*', function($view) {
            $site_slug = Route::current()->parameter('slug');
            $site = Site::where('slug',$site_slug)->first();

            $view->with(compact('site'));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
