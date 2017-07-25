<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
            return new \App\Repositories\API\SongRepository($this->app);
        });

        $this->app->bind('App\Repositories\API\Contracts\BandRepository', function($app) {
            return new \App\Repositories\API\BandRepository($this->app);
        });

        $this->app->bind('App\Repositories\API\Contracts\AlbumRepository', function($app) {
            return new \App\Repositories\API\AlbumRepository($this->app);
        });

        $this->app->bind('App\Repositories\API\Contracts\VideoRepository', function($app) {
            return new \App\Repositories\API\VideoRepository($this->app);
        });
    }
}
