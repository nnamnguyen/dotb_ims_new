<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\SearchFields;

/**
 *
 * Search Fields Handler interface
 *
 */
interface SearchFieldsHandlerInterface extends HandlerInterface
{
    /**
     * Build search fields
     * @param SearchFields $sf
     * @param string $module Module name
     * @param string $field Field name
     * @param array $defs Field definitions
     * @return array
     */
    public function buildSearchFields(SearchFields $sf, $module, $field, array $defs);

    /**
     * Return a list of supported searchable types
     * @return array
     */
    public function getSupportedTypes();
}
