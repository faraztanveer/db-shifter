<?php

namespace MultiDB;

use Illuminate\Support\ServiceProvider;

class MultiDbServiceProvider extends ServiceProvider
{



    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }


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


    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\MultiDbMigrateCommand::class,
            ]);
        }
    }
}
