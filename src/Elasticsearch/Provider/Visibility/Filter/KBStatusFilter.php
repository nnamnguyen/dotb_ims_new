<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

/**
 *
 * Knowledge Base status filter
 *
 */
class KBStatusFilter implements FilterInterface
{
    use FilterTrait;

    /**
     * {@inheritdoc}
     */
    public function buildFilter(array $options = array())
    {
        $field = $options['module'] . Mapping::PREFIX_SEP . 'status.kbvis';
        return new \Elastica\Query\Terms($field, $options['published_statuses']);
    }
}
