<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Diadiem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //share view
        view()->composer('client.layout_client.menu_client', function($view){
            $diadiem = Diadiem::all();
            $view->with('diadiem',$diadiem);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
