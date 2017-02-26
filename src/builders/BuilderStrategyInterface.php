<?php

namespace shamanzpua\apirequest\builders;

/**
 * Strategy for building request
 */
interface BuilderStrategyInterface
{
    /**
     * Build request
     */
    public function build();
    
    /**
     * Get http method
     */
    public function getMethod();
    
    /**
     * Get http options
     */
    public function getOptions();
    
    /**
     * Get request query string
     */
    public function getQuery();
}
