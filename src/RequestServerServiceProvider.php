<?php

namespace Fh\RequestServer;

use Fh\RequestServer\RequestManager\RpcService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Vladmeh\RabbitMQ\Services\Rpc;

class RequestServerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/request-server.php',
            'request-server'
        );

        $this->app->bind(RpcService::class, function () {
            $rpcClient = new Rpc(['connection' => [
                'read_write_timeout' => 20.0,
                'channel_rpc_timeout' => 20.0,
            ]]);

            return new RpcService($rpcClient);
        });
    }

    public function boot()
    {
        $this->registerLogging();
        $this->registerPublishing();
    }

    private function registerLogging()
    {
        try {
            $this->app->make('config')->set('logging.channels.rabbit', [
                'driver' => 'daily',
                'path' => storage_path('logs/rabbit/rabbit.log'),
                'level' => 'debug',
                'days' => 14,
            ]);
        } catch (BindingResolutionException $e) {
            Log::error($e->getMessage());
        }
    }

    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/request-server.php' => config_path('request-server.php'),
            ], 'request-server-config');
        }
    }
}
