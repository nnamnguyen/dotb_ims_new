<?php


namespace Dotbcrm\Dotbcrm\SearchEngine\Capability\Aggregation;

use Dotbcrm\Dotbcrm\SearchEngine\Capability\GlobalSearch\GlobalSearchCapable;

/**
 *
 * Aggregation (facet) capability implying the GlobalSearch capability
 *
 */
interface AggregationCapable extends GlobalSearchCapable
{
    /**
     * Query cross module aggregations, default false.
     * @param boolean $toggle
     * @return AggregationCapable
     */
    public function queryCrossModuleAggs($toggle);

    /**
     * Query module specific aggregations, default empty.
     * @param array $modules
     * @return AggregationCapable
     */
    public function queryModuleAggs(array $modules);

    /**
     * Set aggregation filters
     * @param array $filters
     * @return AggregationCapable
     */
    public function aggFilters(array $filters);
}
