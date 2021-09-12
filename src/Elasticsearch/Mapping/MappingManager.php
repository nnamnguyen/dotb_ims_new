<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\ProviderCollection;

/**
 *
 * Mapping manager is responsible to build the Elasticsearch mapping. The
 * definition of the mapping properties is owned by the different Providers.
 * The Mapping Manager orchestrates the creation of the full mapping and
 * passes it along to the Index Manager which is responsible to send it
 * all to the Elasticsearch backend.
 *
 */
class MappingManager
{
    /**
     * Build mapping for given provider collection.
     *
     * @param ProviderCollection $providers
     * @param array $modules List of modules
     * @return \Dotbcrm\Dotbcrm\Dotbcrm\Elasticsearch\Mapping\MappingCollection
     */
    public function buildMapping(ProviderCollection $providers, array $modules)
    {
        // Create mapping iterator for requested modules
        $collection = new MappingCollection($modules);

        foreach ($collection as $mapping) {
            /* @var $mapping Mapping */
            $mapping->buildMapping($providers);
        }
        return $collection;
    }

    public function loadMapping(array $modules)
    {

    }

    public function compareMapping()
    {

    }
}
