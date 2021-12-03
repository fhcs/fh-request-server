<?php

namespace Fh\RequestServer\Factories;

use Fh\RequestServer\RequestManager\RequestHandler;

abstract class RequestHandlerFactory
{
    /**
     * @return RequestHandler
     */
    abstract public function requestHandler(): RequestHandler;
}