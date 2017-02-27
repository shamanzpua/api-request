<?php
namespace shamanzpua\apirequest;

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
