<?php
namespace shamanzpua\apirequest;

use shamanzpua\apirequest\RequestConfigInterface;
use shamanzpua\apirequest\ApiInterface;

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
            return $congigurator->getBaseUrl($this->getBaseUrl());
        }
        
        throw new Exception($className . " is not implements RequestConfigInterface");
    }
}
