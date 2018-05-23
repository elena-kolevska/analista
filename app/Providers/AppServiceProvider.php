<?php

namespace App\Providers;

use App\Tweet;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(Tweet::class, function($app){
            return new Tweet($app->make('redis'));
        });
    }
}
