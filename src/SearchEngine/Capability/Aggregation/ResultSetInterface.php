<?php


namespace Dotbcrm\Dotbcrm\SearchEngine\Capability\Aggregation;

use Dotbcrm\Dotbcrm\SearchEngine\Capability\GlobalSearch\ResultSetInterface as BaseInterface;

/**
 *
 * ResultSet interface for Aggregation capability
 *
 */
interface ResultSetInterface extends BaseInterface
{
    /**
     * Get aggregations.
     * @return array
     */
    public function getAggregations();
}
