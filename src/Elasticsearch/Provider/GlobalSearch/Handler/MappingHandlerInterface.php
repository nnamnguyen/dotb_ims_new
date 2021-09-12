<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

/**
 *
 * Mapping builder capable interface
 *
 */
interface MappingHandlerInterface extends HandlerInterface
{
    /**
     * Build mapping
     * @param Mapping $mapping
     * @param string $field Field name
     * @param array $defs Field definitions
     */
    public function buildMapping(Mapping $mapping, $field, array $defs);
}
