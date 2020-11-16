<?php

namespace Fh\RequestServer;

use Illuminate\Support\ServiceProvider;

class RequestServerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'request-server'
        );
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => $this->app->configPath('request-server.php'),
            ], 'request-server');
        }
    }
}
