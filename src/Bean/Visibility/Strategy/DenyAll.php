<?php


namespace Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;

use DBManager;
use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;
use DotbQuery;

/**
 * Denies access to all data
 */
final class DenyAll implements Strategy
{
    public function applyToQuery(DotbQuery $query, $table)
    {
        $query->where()->addRaw('1 != 1');
    }

    public function applyToFrom(DBManager $db, $query, $table)
    {
        return $query;
    }

    public function applyToWhere(DBManager $db, $query, $table)
    {
        $conditions = [];

        if ($query) {
            $conditions[] = $query;
        }

        $conditions[] = '1 != 1';

        return implode(' AND ', $conditions);
    }
}
