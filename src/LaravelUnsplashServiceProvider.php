<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use Illuminate\Support\ServiceProvider;

class LaravelUnsplashServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/unsplash.php' => config_path('unsplash.php'),
        ]);
    }

    public function register()
    {
        //
    }
}