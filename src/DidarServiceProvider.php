<?php

namespace MeysamHosseini\Didar;

use Illuminate\Support\ServiceProvider;

class DidarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . './../config/didar.php' => config_path('didar.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton("Didar", function () {
            return new Didar(config('didar.api_key'));
        });
    }
}