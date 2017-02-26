<?php
namespace shamanzpua\apirequest\request;

use shamanzpua\apirequest\builders\ContextRequestBuilder;
use shamanzpua\apirequest\RequestInterface;
use GuzzleHttp\Client;

/**
 * Class request
 */
class Request implements RequestInterface
{
    /**
     * @var const http code 200
     */
    const HTTP_SUCCESS_200 = 200;
    
    /**
     * @var ContextRequestBuilder
     */
    private $builder;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var Psr\Http\Message\MessageInterface|Psr\Http\Message\ResponseInterface
     */
    private $response;

    public function __construct(ContextRequestBuilder $builder)
    {
        $this->builder = $builder->build();
        $this->httpClient = new Client();
    }

    /**
     * Send request
     */
    public function send()
    {
        $builder = $this->builder;
        $this->response = $this->httpClient->request(
            $builder->getMethod(),
            $builder->getQuery(),
            $builder->getOptions()
        );

        return $this;
    }

    /**
     * Get response
     */
    public function getResonseData()
    {
        if ($this->response->getStatusCode() !== self::HTTP_SUCCESS_200) {
            throw new Exception("Request error code: ". $this->response->getStatusCode());
        }
        return $this->response->getBody()->getContents();
    }
}
