<?php
namespace MultiDB;
use Illuminate\Support\ServiceProvider;

class MultiDbServiceProvider extends ServiceProvider 
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() 
    {
        $this->app->singleton('multidb', function ($app) {
            return new Database\DatabaseShifter($app['config'], $app['db']);
        });
    }
}