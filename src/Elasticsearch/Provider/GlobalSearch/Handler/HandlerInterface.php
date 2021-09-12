<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\GlobalSearch;

/**
 *
 * Handler marker interface
 *
 */
interface HandlerInterface
{
    /**
     * Set global search provider
     * @param GlobalSearch $provider
     */
    public function setProvider(GlobalSearch $provider);

    /**
     * Return the handler name
     * @return string
     */
    public function getName();
}
