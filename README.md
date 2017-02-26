# Apirequest

Template for different api requests.

## Installation

Add to composer.json
````
 "require": {
    "shamanzpua/apirequest": "1.2"
 }
````
## Usage

#### Create new custom class Builder:

```php
<?php

namespace components\request\builders;

use shamanzpua\apirequest\builders\BuilderStrategyInterface;
use shamanzpua\apirequest\builders\AbstractRequestBuilder;

/**
 * Class for building request for example api
 */
class ExampleBuilder extends AbstractRequestBuilder implements BuilderStrategyInterface
{
    const ALLOWED_METHODS = ['GET'];

    protected $api = "/example";


    /**
     * Allowed params for query
     */
    public function getAllowedQueryParams()
    {
        return array_merge(
            parent::getAllowedQueryParams(),
            [
                'q' => [],
            ]
        );
    }

    /**
     * Build request
     */
    public function build()
    {
        if (!empty($this->queryParams)) {
            $this->query = "?". http_build_query($this->queryParams);
        }
        $this->query = $this->baseUrl.$this->api. $this->query;
    }
}

```

#### Use in code:

````php
<?php

use shamanzpua\apirequest\RequestConfig;
use shamanzpua\apirequest\Request;
use shamanzpua\apirequest\builders\ContextRequestBuilder;
use components\request\builders\ExampleBuilder;


$queryParams = [
            'q' => $search,
            'key' => $this->apiKey,
            'site' => 'stackoverflow',
        ];

$requestConfig = new RequestConfig();
$requestConfig
    ->setBaseUrl($this->apiBaseUrl)
    ->setHttpMethod(RequestConfig::HTTP_METHOD_GET)
    ->setQueryParams($queryParams);

$request = new Request(
    new ContextRequestBuilder(new ExampleBuilder($requestConfig))
);
$response = $request->send()->getResonseData();





````
