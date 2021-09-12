<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query;

use Elastica\Query\MatchAll;

/**
 *
 * The match all query without search terms
 *
 */
class MatchAllQuery implements QueryInterface
{
    /**
     * Create a match all query
     * @return MatchAll
     */
    public function build()
    {
        return new MatchAll();
    }
}
