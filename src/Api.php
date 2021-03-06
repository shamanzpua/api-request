<?php
namespace shamanzpua\apirequest;

use shamanzpua\apirequest\RequestConfigInterface;
use shamanzpua\apirequest\ApiInterface;
use shamanzpua\apirequest\builders\BuilderStrategyInterface;
use shamanzpua\apirequest\builders\ContextRequestBuilder;

/**
 * Stackechchange api class
 */
abstract class Api implements ApiInterface
{
    protected $apiBaseUrl;
    
    /**
     * @inheritdoc
     */
    public function getBaseUrl()
    {
        if (!$this->apiBaseUrl) {
            throw new Exception("'apiBaseUrl' property is not configured...");
        }
        return $this->apiBaseUrl;
    }
    
    /**
     * @inheritdoc
     */
    public function setBaseUrl($url)
    {
        $this->apiBaseUrl = $url;
    }
    
    /**
     * Creating request for api requestconfigurator
     *
     *  use result of the parent::createConfigurator if you want to add something
     *
     * @param string $className  classname Example::class
     * @return RequestConfigInterface
     * @throws Exception
     */
    public function createConfigurator($className)
    {
        if (!class_exists($className)) {
            throw new Exception($className . " class does not exist");
        }
        $configurator = new $className();
        if ($configurator instanceof RequestConfigInterface) {
            return $configurator->setBaseUrl($this->getBaseUrl());
        }
        
        throw new Exception($className . " is not implements RequestConfigInterface");
    }
    
    /**
     * Create RequestInterface and send request
     *
     * @param shamanzpua\apirequest\RequestInterface $request
     * @return RequestInterface
     */
    public function sendRequest(RequestInterface $request)
    {
        return $request->send()->getResonseData();
    }

    /**
     * Create BuilderStrategyInterface
     *
     * @param shamanzpua\apirequest\builders\BuilderStrategyInterface $builder
     * @return ContextRequestBuilder
     */
    public function createBuilder(BuilderStrategyInterface $builder)
    {
        return new ContextRequestBuilder($builder);
    }
}
