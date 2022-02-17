<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Http\Controllers\V1\AuthController', function () {
            return new \App\Http\Controllers\V1\AuthController(
                new \App\Survey\ServicesImpl\UserServiceImpl(
                    new \App\Survey\RepositoriesImpl\UserRepositoryImpl
                )
            );
        });
        $this->app->bind('App\Http\Controllers\V1\SurveyController', function () {
            return new \App\Http\Controllers\V1\SurveyController(
                new \App\Survey\ServicesImpl\SurveyServiceImpl(
                    new \App\Survey\RepositoriesImpl\SurveyRepositoryImpl
                )
            );
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
