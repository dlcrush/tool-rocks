<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class ProcessorServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Processors\Contracts\VideoProcessor', function($app) {
            return new \App\Processors\VideoProcessor($app->make('App\Repositories\API\Contracts\YouTubeRepository'));
        });
    }

}
