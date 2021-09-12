<?php


/**
 * Class DotbQuery_Builder_Union.
 */
class DotbQuery_Builder_Union
{
    /**
     * @var DotbQuery
     */
    protected $query;

    /**
     * Array of union queries.
     * @var array
     */
    protected $queries = array();

    /**
     * Create Union Object.
     * @param DotbQuery $query
     */
    public function __construct(DotbQuery $query)
    {
        $this->query = $query;
    }

    /**
     * Add new query for union.
     * @param DotbQuery $query Query object to add.
     * @param bool $all (optional) Indicates should 'UNION ALL' be used or not. Default is `true`.
     */
    public function addQuery(DotbQuery $query, $all = true)
    {
        $this->queries[] = array('query' => $query, 'all' => (boolean) $all);
    }

    /**
     * Return queries for union.
     * @return array Set of query objects.
     */
    public function getQueries()
    {
        return $this->queries;
    }
}
