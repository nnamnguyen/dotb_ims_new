<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query;


/**
 *
 * Query interface
 *
 */
interface QueryInterface
{
    /**
     * Build the query
     * @return \Elastica\Query\AbstractQuery
     */
    public function build();
}
