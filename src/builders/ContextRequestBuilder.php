<?php
namespace shamanzpua\apirequest\builders;

use shamanzpua\apirequest\builders\BuilderStrategyInterface;

/**
 * Context request builder
 */
class ContextRequestBuilder
{

    public function __construct(BuilderStrategyInterface $buildStartegy)
    {
        $this->buildStartegy = $buildStartegy;
    }

    /**
     * @var BuilderStrategyInterface
     */
    private $buildStartegy;

    /**
     * Building request by any BuilderStrategyInterface builder
     *
     * @return ContextRequestBuilder
     */
    public function build()
    {
        $this->buildStartegy->build();
        return $this;
    }
    
    /**
     * Get method of BuilderStrategyInterface instance
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->buildStartegy->getMethod();
    }
    
    /**
     * Get options of BuilderStrategyInterface instance
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->buildStartegy->getOptions();
    }
    
    /**
     * Get query of BuilderStrategyInterface instance
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->buildStartegy->getQuery();
    }
}
