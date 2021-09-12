<?php


namespace Dotbcrm\Dotbcrm\Bean\Visibility\Layer;

use DotbQuery as Query;
use DotbQueryException;

/**
 * Visibility applied to DotbQuery
 */
interface DotbQuery
{
    /**
     * Apply visibility filter to DotbQuery
     *
     * @param Query $query
     * @param string $table The table to apply the visibility rules to
     *
     * @return void
     * @throws DotbQueryException
     */
    public function applyToQuery(Query $query, $table);
}
