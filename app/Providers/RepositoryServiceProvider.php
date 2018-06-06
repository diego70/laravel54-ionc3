<?php

namespace BluesFlix\Providers;

use BluesFlix\Repositories\CategoryRepository;
use BluesFlix\Repositories\CategoryRepositoryEloquent;
use BluesFlix\Repositories\UserRepository;
use BluesFlix\Repositories\UserRepositoryEloquent;
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
        //:end-bindings:
    }
}
