<?php


namespace Dotbcrm\Dotbcrm\Bean\Visibility\Layer;

use DBManager;

/**
 * Visibility applied to plain SQL
 */
interface Sql
{
    /**
     * Apply visibility filter to the FROM part of the query
     *
     * @param DBManager $db
     * @param string $query Original query
     * @param string $table Table to apply the visibility rules to
     *
     * @return string Modified query
     */
    public function applyToFrom(DBManager $db, $query, $table);

    /**
     * Apply visibility filter to the WHERE part of the query
     *
     * @param DBManager $db
     * @param string $query Original query
     * @param string $table The table to apply the visibility rules to
     *
     * @return string Modified query
     */
    public function applyToWhere(DBManager $db, $query, $table);
}
