<?php

namespace Bravist\DistrictExplorer;

use Illuminate\Support\ServiceProvider;

class DistrictExplorerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();

            $this->registerSeeds();

            $this->publishes([
                __DIR__.'/database/migrations' => database_path('migrations'),
            ]);

            $this->publishes([
                __DIR__.'/database/seeds' => database_path('seeds'),
            ]);
        }
    }

    /**
     * Register district's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        return $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register district's migration files.
     *
     * @return void
     */
    protected function registerSeeds()
    {
        return $this->loadMigrationsFrom(__DIR__.'/database/seeds');
    }
}
