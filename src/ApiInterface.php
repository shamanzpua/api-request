<?php
namespace shamanzpua\apirequest;

use shamanzpua\apirequest\builders\BuilderStrategyInterface;
use shamanzpua\apirequest\RequestInterface;

/**
 * Interface for api
 */
interface ApiInterface
{
    /**
     * Creating request for api requestconfigurator
     *
     * @param string $className
     * @return RequestConfigInterface
     */
    public function createConfigurator($className);
    
    /**
     * Create RequestInterface and send request
     *
     * @param shamanzpua\apirequest\RequestInterface $request
     * @return RequestInterface
     */
    public function sendRequest(RequestInterface $request);
    
    /**
     * Create BuilderStrategyInterface
     *
     * @param shamanzpua\apirequest\builders\BuilderStrategyInterface $builder
     * @return ContextRequestBuilder
     */
    public function createBuilder(BuilderStrategyInterface $builder);

    /**
     * Get base url
     *
     * @return string
     */
    public function getBaseUrl();
    
    /**
     * Get base url
     *
     * @return string
     */
    public function setBaseUrl($url);
}
