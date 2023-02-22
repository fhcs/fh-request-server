<?php

namespace Fh\RequestServer\RequestManager;

use Illuminate\Support\Facades\Log;
use Vladmeh\XmlUtils\Xml;

abstract class AbstractRequestHandler implements RequestHandler
{
    /**
     * @var string
     */
    protected string $typeRequest = '';

    /**
     * @var string
     */
    protected string $response;

    /**
     * @var array
     */
    protected array $requestData = [];

    /**
     * @var array
     */
    protected array $responseData = [];

    /**
     * RequestFactory constructor.
     */
    public function __construct()
    {
        $this->setRequestData();
    }

    abstract protected function setRequestData(): void;

    /**
     * @return array
     */
    public function responseData(): array
    {
        return $this->responseData;
    }

    /**
     * @param RpcService $rpcService
     */
    public function handle(RpcService $rpcService): void
    {
        $response = $rpcService
            ->request($this->makeMessage(), config('request-server.rabbit.request'))
            ->response();

        $this->setResponse($response)->setResponseData();
        $this->loggingRabbit();
    }

    /**
     * @return string
     */
    public function makeMessage(): string
    {
        return MessageRequest::make($this->typeRequest, $this->requestData)
            ->toXml(true);
    }

    protected function setResponseData(): void
    {
        $this->responseData = Xml::toArray(simplexml_load_string($this->response)->xpath('//RESPONSE'));
    }

    /**
     * @param string $response
     * @return self
     */
    public function setResponse(string $response): self
    {
        $this->response = $response;
        return $this;
    }

    protected function loggingRabbit()
    {
        $message = sprintf("Request rabbit type: %s\nRequest: %s\nResponse: %s\n",
            $this->typeRequest,
            json_encode($this->requestData, JSON_UNESCAPED_UNICODE),
            json_encode($this->responseData, JSON_UNESCAPED_UNICODE));
        Log::channel('rabbit')->info($message);
    }

    /**
     * @return string
     */
    public function response(): string
    {
        return $this->response;
    }

    /**
     * @return array|null
     */
    public function errorData(): ?array
    {
        return $this->hasResponseError() ? $this->responseData['error'] : null;
    }

    /**
     * @return bool
     */
    public function hasResponseError(): bool
    {
        return isset($this->responseData['error']);
    }
}
