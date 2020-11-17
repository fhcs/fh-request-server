<?php

namespace Fh\RequestServer;

use Fh\RequestServer\RequestManager\RpcService;
use Illuminate\Support\ServiceProvider;
use Vladmeh\RabbitMQ\Services\Rpc;

class RequestServerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RpcService::class, function () {
            $rpcClient = new Rpc(['connection' => [
                'read_write_timeout' => 20.0,
                'channel_rpc_timeout' => 20.0,
            ]]);

            return new RpcService($rpcClient);
        });

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
