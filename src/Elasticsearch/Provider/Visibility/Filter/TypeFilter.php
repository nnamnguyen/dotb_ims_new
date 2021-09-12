<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

/**
 *
 * Type (module) filter
 *
 */
class TypeFilter implements FilterInterface
{
    use FilterTrait;

    /**
     * {@inheritdoc}
     */
    public function buildFilter(array $options = array())
    {
        $filter = new \Elastica\Query\Term();
        $filter->setTerm('_type', $options['module']);
        return $filter;
    }
}
