<?php

namespace shamanzpua\apirequest;

/**
 * Request interface
 */
interface RequestInterface
{
    /**
     * Send request
     *
     * @return RequestInterface
     */
    public function send();
    
    /**
     * Get data from response
     *
     * @return mixed
     */
    public function getResonseData();
}
