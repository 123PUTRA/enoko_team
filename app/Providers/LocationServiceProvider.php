<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LocationService;


class LocationServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('LocationService', function () {
            return new LocationService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
