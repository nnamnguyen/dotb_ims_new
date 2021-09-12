<?php


namespace Dotbcrm\Dotbcrm\SearchEngine\Capability\GlobalSearch;

/**
 *
 * ResultSet interface for GlobalSearch capability
 *
 */
interface ResultSetInterface
{
    /**
     * Get total hit count
     * @return integer
     */
    public function getTotalHits();

    /**
     * Get query execution time in miliseconds
     * @return integer
     */
    public function getQueryTime();
}
