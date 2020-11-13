<?php


namespace Fh\RequestServer\Request;


use Vladmeh\RabbitMQ\Facades\Rabbit;

abstract class DataRequestRpc implements DataRequest
{
    /**
     * @var string
     */
    protected $response;

    protected $config;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->response = $this->response();
    }

    /**
     * @return string
     */
    public function response(): string
    {
        return Rabbit::rpc(
            $this->messageRequest(),
            config('rabbit.queues.request'),
            [
                'connection' => [
                    'read_write_timeout' => 20.0,
                    'channel_rpc_timeout' => 20.0
                ]
            ]
        );
    }

    /**
     * @return string
     */
    abstract public function messageRequest(): string;
}
