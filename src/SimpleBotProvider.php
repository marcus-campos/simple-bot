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
        if(env('APP_ENV', 'production') == 'production')
            \URL::forceScheme('https');

        $this->loadViewsFrom(__DIR__.'/resources', 'marcus-campos/simple-bot');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes/routes.php';
    }
}
