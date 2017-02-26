<?php

namespace shamanzpua\apirequest\request;

/**
 * Class for configuration request
 */
class RequestConfig implements RequestConfigInterface
{
    private $method;
    private $baseUrl;
    private $queryParams = [];
    private $pathParams = [];
    private $options = [];
    
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_PATCH = 'PATCH';
    const HTTP_METHOD_DELETE = 'DELETE';
    const HTTP_METHOD_HEAD = 'HEAD';
    const HTTP_METHOD_OPTIONS = 'OPTION';
    
    /**
     * @inheritdoc
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @inheritdoc
     */
    public function getHttpMethod()
    {
        return $this->method;
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @inheritdoc
     */
    public function getPathParams()
    {
        return $this->pathParams;
    }

    /**
     * @inheritdoc
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @inheritdoc
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setBodyParam($param, $value)
    {
        $this->options['form_params'][$param] = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setBodyParams($params)
    {
        return $this->setParams($params, 'setBodyParam');
    }
    
    /**
     * @inheritdoc
     */
    public function setParams($params, $method)
    {
        if (empty($params)) {
            return $this;
        }
        if (!is_array($params)) {
            throw new Exception('Params configuration failed. Array expected');
        }
        foreach ($params as $param => $value) {
            $this->$method($param, $value);
        }
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function setHeader($header, $value)
    {
        $this->options['headers'][$header] = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setHeaders($params)
    {
        return $this->setParams($params, 'setHeader');
    }

    /**
     * @inheritdoc
     */
    public function setHttpMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPathParam($param, $value)
    {
        $this->pathParams[$param] = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPathParams($params)
    {
        return $this->setParams($params, 'setPathParam');
    }

    /**
     * @inheritdoc
     */
    public function setQueryParam($param, $value)
    {
        $this->queryParams[$param] = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setQueryParams($params)
    {
        return $this->setParams($params, 'setQueryParam');
    }

    /**
     * @inheritdoc
     */
    public function setFileParam($param, $file)
    {
        $this->options['multipart'][] = ['name' => $param, 'contents' => $file];
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setFileParams($params)
    {
        return $this->setParams($params, 'setFileParam');
    }
}
