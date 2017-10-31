<?php

namespace SimpleBot;

use Illuminate\Support\ServiceProvider;

class SimpleBotProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources', 'marcus-campos/simple-bot');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
