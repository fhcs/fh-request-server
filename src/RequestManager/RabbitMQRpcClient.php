<?php


namespace Fh\RequestServer\RequestManager;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Log;
use Vladmeh\RabbitMQ\Contracts\RpcClient;
use Vladmeh\RabbitMQ\Services\Rpc;

trait RabbitMQRpcClient
{
    /**
     * @return RpcClient | void
     */
    public function rpcClient(): RpcClient
    {
        try {
            return new Rpc(['connection' => [
                'read_write_timeout' => 20.0,
                'channel_rpc_timeout' => 20.0,
            ]]);
        } catch (BindingResolutionException $e) {
            Log::error($e->getMessage());
        }
    }
}