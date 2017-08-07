<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\API\Contracts\SongRepository', function($app) {
            return new \App\Repositories\API\SongRepository($this->app, $app->make('Illuminate\Support\Collection'));
        });

        $this->app->bind('App\Repositories\API\Contracts\BandRepository', function($app) {
            return new \App\Repositories\API\BandRepository($this->app, $app->make('Illuminate\Support\Collection'));
        });

        $this->app->bind('App\Repositories\API\Contracts\AlbumRepository', function($app) {
            return new \App\Repositories\API\AlbumRepository($this->app, $app->make('Illuminate\Support\Collection'));
        });

        $this->app->bind('App\Repositories\API\Contracts\VideoRepository', function($app) {
            return new \App\Repositories\API\VideoRepository($this->app, $app->make('Illuminate\Support\Collection'));
        });

        $this->app->bind('App\Repositories\API\Contracts\IpsumRepository', function($app) {
            return new \App\Repositories\API\IpsumRepository($this->app, $app->make('Illuminate\Support\Collection'));
        });
    }
}
