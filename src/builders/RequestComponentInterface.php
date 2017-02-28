<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace shamanzpua\apirequest\builders;

/**
 * Parts of request interface
 */
interface RequestComponentInterface
{
    /**
     * Get http method
     * 
     * @return string
     */
    public function getMethod();
    
    /**
     * Get http options
     * 
     * @return array
     */
    public function getOptions();
    
    /**
     * Get request query string
     * 
     * @return string final query 
     */
    public function getQuery();
    
    /**
     * Create final request query
     */
    public function create();
}
