<?php

namespace shamanzpua\apirequest\request;

/**
 *
 * @author shaman
 */
interface RequestInterface
{
    /**
     * Send request
     */
    public function send();
    
    /**
     * Get data from response
     */
    public function getResonseData();
}
