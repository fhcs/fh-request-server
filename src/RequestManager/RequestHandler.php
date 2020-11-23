<?php


namespace Fh\RequestServer\RequestManager;


interface RequestHandler
{
    public function handle(RpcService $rpcService): void;
}