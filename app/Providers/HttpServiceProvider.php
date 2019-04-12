<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class HttpServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Library\Http\Contracts\Http', function($app) {
            return new \App\Library\Http\Http(new Client, [], $app->make('Illuminate\Cache\Repository'));
        });

        $this->app->bind('App\Library\Http\Contracts\UrlBuilder', function($app) {
            return new \App\Library\Http\UrlBuilder($app->make('App\Library\Http\ParamsBuilder'));
        });

        $this->app->bind('App\Library\Http\Contracts\ParamsBuilder', function($app) {
            return new \App\Library\Http\ParamsBuilder();
        });
    }
}
