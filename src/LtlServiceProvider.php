<?php

namespace edgewizz\ltl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LtlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Ltl\Controllers\LtlController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'ltl');
        Blade::component('ltl::ltl.open', 'ltl.open');
        Blade::component('ltl::ltl.index', 'ltl.index');
        Blade::component('ltl::ltl.edit', 'ltl.edit');
    }
}
