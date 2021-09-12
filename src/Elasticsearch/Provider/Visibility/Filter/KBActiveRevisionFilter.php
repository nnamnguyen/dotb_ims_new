<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

/**
 *
 * Knowledge Base active revision filter.
 *
 */
class KBActiveRevisionFilter implements FilterInterface
{
    use FilterTrait;

    /**
     * {@inheritdoc}
     */
    public function buildFilter(array $options = array())
    {
        $field = $options['module'] . Mapping::PREFIX_SEP . 'active_rev.kbvis';
        $filter = new \Elastica\Query\Term();
        $filter->setTerm($field, 1);
        return $filter;
    }
}
