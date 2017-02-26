<?php
namespace shamanzpua\apirequest\request;

/**
 * interface for
 */
interface RequestConfigInterface
{
    /**
     * @return string base url
     */
    public function getBaseUrl();
    
    /**
     * @return array options array (headers, form data, etc.)
     */
    public function getOptions();
    
    /**
     * @return array query params array
     */
    public function getQueryParams();
    
    /**
     * @return array path params array
     */
    public function getPathParams();
    
    /**
     * @return string Http method
     */
    public function getHttpMethod();
    
    /**
     * @param string $baseUrl base url
     * @return RequestConfigInterface
     */
    public function setBaseUrl($baseUrl);
    
    /**
     * @param string $param param
     * @param string $value value
     * @return RequestConfigInterface
     */
    public function setQueryParam($param, $value);
    
     /**
     * @param string $param param
     * @param string $value value
     * @return RequestConfigInterface
     */
    public function setBodyParam($param, $value);
    
    /**
     * @param string $header header
     * @param string $value value
     * @return RequestConfigInterface
     */
    public function setHeader($header, $value);
    
    /**
     * @param string $param param
     * @param string $value value
     * @return RequestConfigInterface
     */
    public function setPathParam($param, $value);
    
    /**
     * @param array $params param => value
     * @return RequestConfigInterface
     */
    public function setQueryParams($params);
    
    /**
     * @param array $params param => value
     * @return RequestConfigInterface
     */
    public function setBodyParams($params);
    
    /**
     * @param array $params param => value
     * @return RequestConfigInterface
     */
    public function setFileParams($params);
    
    /**
     * @param array $params param => value
     * @return RequestConfigInterface
     */
    public function setHeaders($params);
    
    /**
     * @param array $params param => value
     * @return RequestConfigInterface
     */
    public function setPathParams($params);
    
    /**
     * @param array $params param => value
     * @param string $method setter method name
     * @return RequestConfigInterface | Exception
     */
    public function setParams($params, $method);
    
    /**
     * @param array $param name
     * @param array $file file
     * @return RequestConfigInterface
     */
    public function setFileParam($param, $file);
    
    /**
     * @return RequestConfigInterface
     */
    public function setHttpMethod($method);
}
