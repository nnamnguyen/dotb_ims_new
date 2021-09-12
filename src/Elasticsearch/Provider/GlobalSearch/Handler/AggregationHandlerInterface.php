<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Query\QueryBuilder;

/**
 *
 * Aggregation handler interface
 *
 */
interface AggregationHandlerInterface extends HandlerInterface
{
    /**
     * Add aggregations to query builder
     * @param QueryBuilder $builder
     */
    public function addAggregations(QueryBuilder $builder);
}
