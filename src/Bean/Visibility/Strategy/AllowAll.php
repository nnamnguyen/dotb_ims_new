<?php


namespace Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;

use DBManager;
use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;
use DotbQuery;

/**
 * Allows access to all data
 */
final class AllowAll implements Strategy
{
    public function applyToQuery(DotbQuery $query, $table)
    {
    }

    public function applyToFrom(DBManager $db, $query, $table)
    {
        return $query;
    }

    public function applyToWhere(DBManager $db, $query, $table)
    {
        return $query;
    }
}
