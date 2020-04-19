<?php

namespace App\Providers;

use App\Http\Repositories\Click108Repository;
use App\Http\Services\click108;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('click108Repository' , function (){
            return new Click108Repository;
        });
    }
}
