<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch;

/**
 *
 * Container Aware Interface
 *
 */
interface ContainerAwareInterface
{
    /**
     * Set service container
     * @param Container $container
     */
    public function setContainer(Container $container);

    /**
     * Get service container
     * @return Container
     */
    public function getContainer();
}
