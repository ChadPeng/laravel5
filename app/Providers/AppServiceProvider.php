<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\click108;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('click108' , function (){
            return new click108;
        });
    }
}
