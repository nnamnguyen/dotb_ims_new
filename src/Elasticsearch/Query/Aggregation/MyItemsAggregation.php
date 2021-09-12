<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation;

/**
 *
 * The implementation class for MyItems Aggregation based on
 * on current user context.
 *
 */
class MyItemsAggregation extends FilterAggregation
{
    /**
     * {@inheritdoc}
     */
    protected function getAggFilter($field)
    {
        $termFilter = new \Elastica\Query\Terms();
        $termFilter->setTerms($field, array($this->user->id));
        return $termFilter;
    }
}
