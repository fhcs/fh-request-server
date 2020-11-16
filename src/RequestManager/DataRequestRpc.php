<?php


namespace Fh\RequestServer\RequestManager;


use Vladmeh\RabbitMQ\Contracts\RpcClient;

abstract class DataRequestRpc
{
    /**
     * @var RpcClient
     */
    protected $rpcClient;

    /**
     * @var string
     */
    protected $message;

    /**
     * DataRequestRpc instance.
     */
    public function __construct()
    {
        $this->rpcClient = $this->rpcClient();
        $this->message = $this->message();
    }

    /**
     * @return RpcClient
     */
    abstract public function rpcClient(): RpcClient;

    /**
     * @return string
     */
    abstract public function message(): string;

    /**
     * @return string
     */
    public function response(): string
    {
        return $this->rpcClient->getResponse();
    }

    /**
     * @param string $queue
     * @return void
     */
    public function request(string $queue): void
    {
        $this->rpcClient->request($this->message, $queue);
    }
}
