<?php

namespace BluesFlix\Providers;

use BluesFlix\Repositories\CategoryRepository;
use BluesFlix\Repositories\CategoryRepositoryEloquent;
use BluesFlix\Repositories\UserRepository;
use BluesFlix\Repositories\UserRepositoryEloquent;
use BluesFlix\Repositories\SerieRepository;
use BluesFlix\Repositories\SerieRepositoryEloquent;
use BluesFlix\Repositories\VideoRepository;
use BluesFlix\Repositories\VideoRepositoryEloquent;
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
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(SerieRepository::class, SerieRepositoryEloquent::class);
        $this->app->bind(VideoRepository::class, VideoRepositoryEloquent::class);
        //:end-bindings:
    }
}
