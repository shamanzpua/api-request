<?php
namespace shamanzpua\apirequest\builders;

use shamanzpua\apirequest\RequestConfigInterface;

/**
 * Abstract request class
 */
abstract class AbstractRequestBuilder
{

    protected $queryParams = [];
    protected $pathParams = [];
    protected $baseUrl;
    protected $options = [];
    protected $method = 'GET';
    protected $query;
    protected $api;

    const ALLOWED_METHODS = [
        'GET',
        'POST',
        'DELETE',
        'PATCH',
        'PUT',
        'HEAD',
        'OPTION',
    ];

    /**
     * Request builder constructor
     *
     * @param RequestConfigInterface $config
     * @throws Exception
     */
    public function __construct(RequestConfigInterface $config)
    {
        //setting base url
        $this->baseUrl = $config->getBaseUrl();
        if (!$this->baseUrl) {
            throw new \Exception("Base url is not set");
        }

        //setting http method
        if ($config->getHttpMethod()) {
            $this->method = $config->getHttpMethod();
        }
        if (!in_array($this->method, static::ALLOWED_METHODS)) {
            throw new \Exception($this->method . " is not allowed");
        }

        //setting option (headers, form data, etc)
        $this->options = $config->getOptions();

        //setting query params
        $this->queryParams = $config->getQueryParams();

        //setting path params
        $this->pathParams = $config->getPathParams();
        $this->validateParams();
    }

    /**
     * Get array of allowed query params
     * 
     *  Example of return array: 
     * <pre>
     * <code>
     *      return [
     *          'key' => []   //any param 'key'     
     *          'order' => ['asc', 'desc']   //onle 'asc' or 'desc' allowed for param 'key'             
     *      ];  
     * <code>
     * <pre>
     * 
     * @return array
     */
    public function getAllowedQueryParams()
    {
        return [];
    }

    /**
     * Get array of allowed body params
     * 
     *  Example of return array: 
     * <pre>
     * <code>
     *      return [
     *          'key' => []   //any param 'key'     
     *          'order' => ['asc', 'desc']   //onle 'asc' or 'desc' allowed for param 'key'             
     *      ];  
     * <code>
     * <pre>
     * 
     * @return array
     */
    public function getAllowedBodyParams()
    {
        return [];
    }

    /**
     * Get array of allowed path params
     * 
     *  Example of return array: 
     * <pre>
     * <code>
     *      return [
     *          'key' => []   //any param 'key'     
     *          'order' => ['asc', 'desc']   //onle 'asc' or 'desc' allowed for param 'key'             
     *      ];  
     * <code>
     * <pre>
     * 
     * @return array
     */
    public function getAllowedPathParams()
    {
        return [];
    }

    /**
     * Get array of path params
     * 
     * Example of return array: 
     * <pre>
     * <code>
     *      return [
     *          'body' => [], //no require params for body
     *          'path' => ['id'],  //param id require in path
     *          'query' => [], //no require params for query
     *      ];  
     * </code>
     * </pre>
     * @return array
     */
    public function getRequiredParams()
    {
        return [
            'body' => [],
            'path' => [],
            'query' => [],
        ];
    }

    /**
     * Checking allowed of query params
     *
     * @param array $params
     * @param sring $method
     * @throws Exception
     */
    public function checkParams($params, $method)
    {
        if (empty($params)) {
            return;
        }
        foreach ($params as $param => $value) {
            $allowedParams = $this->$method();
            if (!array_key_exists($param, $allowedParams)) {
                throw new \Exception("Param is not allowed");
            }
            if (empty($allowedParams[$param])) {
                continue;
            }
            if (!in_array($value, $allowedParams[$param])) {
                throw new \Exception($value . " is not allowed value for " . $param . " param");
            }
        }
    }

    /**
     * Checking require params
     */
    public function checkRequire()
    {
        $require = $this->getRequiredParams();
        
        $formParams = isset($this->options['form_params']) ? $this->options['form_params'] : [];
        if (isset($require['body'])) {
            $this->checkRequireByType($require['body'], $formParams);
        }
        if (isset($require['path'])) {
            $this->checkRequireByType($require['path'], $this->pathParams);
        }
        if (isset($require['query'])) {
            $this->checkRequireByType($require['query'], $this->queryParams);
        }
    }

    /**
     * Checking by type of sending data
     *
     * @param array $require
     * @param array $paramsArray
     * @throws Exception
     */
    public function checkRequireByType($require, $paramsArray)
    {
        if (isset($require) && !empty($require)) {
            foreach ($require as $value) {
                if (!array_key_exists($value, $paramsArray)) {
                    throw new \Exception("Param '" . $value . "' is required");
                }
            }
        }
    }

    /**
     * Validate request params
     */
    public function validateParams()
    {
        $this->checkParams($this->queryParams, 'getAllowedQueryParams');
        $this->checkParams($this->pathParams, 'getAllowedPathParams');
        if (isset($this->options['form_params'])) {
            $this->checkParams($this->options['form_params'], 'getAllowedBodyParams');
        }
        $this->checkRequire();
    }

    /**
     * Get http method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get http options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get request query string
     */
    public function getQuery()
    {
        return $this->query;
    }
    
    /**
     * Build path
     *
     * @return $this
     */
    public function buildPath()
    {
        if (!empty($this->pathParams)) {
            foreach ($this->pathParams as $param => $value) {
                $this->api = str_replace("{".$param."}", $value, $this->api);
            }
        }
        return $this;
    }
    
    /**
     * Build query string
     *
     * @return $this
     */
    public function buildQuery()
    {
        if (!empty($this->queryParams)) {
            $this->query = "?". http_build_query($this->queryParams);
        }
        return $this;
    }
    /**
     * Create final request query
     */
    public function create()
    {
        $this->query = $this->baseUrl.$this->api.$this->query;
    }
}
