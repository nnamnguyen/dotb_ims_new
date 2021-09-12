<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property;

/**
 *
 * Low level mapping property interface
 *
 */
interface PropertyInterface
{
    /**
     * Get property mapping definition
     * @return array
     */
    public function getMapping();

    /**
     * Set mapping explicitly
     * @param array $mapping
     */
    public function setMapping(array $mapping);

    /**
     * Add copy_to field definition
     * @param string $field Field name to copy to
     */
    public function addCopyTo($field);
}
