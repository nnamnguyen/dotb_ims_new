<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property;

/**
 *
 * This mapping property defines a nested object property. This object
 * extends from the ObjectProperty and the same rules apply that such
 * objects cannot be stacked on top as a regular MultiFieldProperty
 * and need to be created on a dedicated field.
 *
 */
class NestedProperty extends ObjectProperty implements PropertyInterface
{
    /**
     * @var string
     */
    protected $type = 'nested';
}
