<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Visibility;

/**
 *
 * Filter interface
 *
 */
interface FilterInterface
{
    /**
     * Set visibility provider
     * @param Visibility $provider
     */
    public function setProvider(Visibility $provider);

    /**
     * Build filter
     * @param array $options
     * @return \Elastica\Query\AbstractQuery
     */
    public function buildFilter(array $options = array());
}
