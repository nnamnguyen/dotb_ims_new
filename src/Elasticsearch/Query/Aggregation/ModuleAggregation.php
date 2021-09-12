<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

/**
 *
 * Module aggregation
 *
 */
class ModuleAggregation extends TermsAggregation
{
    /**
     * Ctor
     * @param integer $size
     */
    public function __construct($size = 5)
    {
        $this->setOptions(array(
            'field' => '_type',
            'size' => $size,
            'order' => array('_count', 'desc'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildMapping(Mapping $mapping, $field, array $defs)
    {
        // Nothing to do here as _type field is already implied in the mapping.
    }

}
