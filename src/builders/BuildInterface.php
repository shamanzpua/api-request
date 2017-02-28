<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace shamanzpua\apirequest\builders;

/**
 * build interface
 */
interface BuildInterface
{
    /**
     * Build request
     * 
     */
    public function build();
    
    /**
     * Build path
     *
     * @return BuildInterface
     */
    public function buildPath();
    
    /**
     * Build query string
     *
     * @return BuildInterface
     */
    public function buildQuery();
}
