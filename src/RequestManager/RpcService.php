<?php


namespace Fh\RequestServer\RequestManager;


use Vladmeh\RabbitMQ\Contracts\RpcClient;

class RpcService
{
    /**
     * @var RpcClient
     */
    private $rpcClient;

    /**
     * Example constructor.
     * @param RpcClient $rpcClient
     */
    public function __construct(RpcClient $rpcClient)
    {
        $this->rpcClient = $rpcClient;
    }

    /**
     * @return string
     */
    public function response(): string
    {
        return $this->rpcClient->getResponse();
    }

    /**
     * @param string $message
     * @param string $queue
     * @return RpcService
     */
    public function request(string $message, string $queue): self
    {
        $this->rpcClient->request($message, $queue);

        return $this;
    }
}
