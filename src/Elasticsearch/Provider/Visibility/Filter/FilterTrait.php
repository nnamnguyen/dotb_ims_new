<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Visibility;

/**
 * Filter trait
 *
 */
trait FilterTrait
{
    /**
     * @var Visibility
     */
    protected $provider;

    /**
     * Set visibility provider
     *
     * @param Visibility $provider
     */
    public function setProvider(Visibility $provider)
    {
        $this->provider = $provider;
    }
}
