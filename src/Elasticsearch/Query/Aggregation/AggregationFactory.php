<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation;

/**
 *
 * Aggregation Factory loads a specific aggregation based on the given type.
 *
 */
class AggregationFactory
{
    /**
     * Local cache
     * @var array
     */
    protected static $loaded = array();

    /**
     * Load aggregation object. Be careful as this is a cached factory.
     * @param string $type
     * @return AggregationInterface
     */
    public static function get($type)
    {
        if (!isset(self::$loaded[$type])) {
            self::$loaded[$type] = self::create($type);
        }
        return self::$loaded[$type];
    }

    /**
     * Create new aggregation object
     * @param string $type
     * @return AggregationInterface
     */
    public static function create($type)
    {
        $className = \DotbAutoLoader::customClass(sprintf(
            'Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation\%sAggregation',
            ucfirst($type)
        ));
        return new $className();
    }
}
