<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch;

/**
 * Container Aware Trait
 *
 */
trait ContainerAwareTrait
{
    /**
     * @var \Dotbcrm\Dotbcrm\Elasticsearch\Container
     */
    protected $container;

    /**
     * Set service container
     *
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get service container
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
