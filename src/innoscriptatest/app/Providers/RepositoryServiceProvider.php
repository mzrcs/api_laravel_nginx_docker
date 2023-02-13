<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            "App\Contracts\IAuthRepository",
            "App\Repositories\AuthRepository"
            );

        $this->app->bind(
            "App\Contracts\IUserRepository",
            "App\Repositories\UserRepository"
            );
        $this->app->bind(
            "App\Contracts\INewsfeedRepository",
            "App\Repositories\NewsfeedRepository"
            );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
