<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;

/**
 *
 * Class DateRangeAggregation covering default list view date range:
 *  - Today
 *  - Yesterday
 *  - Tomorrow
 *  - Last 7 days
 *  - Next 7 days
 *  - Last 30 Days
 *  - Next 30 Days
 *  - Last Month
 *  - This month
 *  - Next Month
 *  - Last Year
 *  - Next Year
 *  - This Year
 */
class DateRangeAggregation extends RangeAggregation
{
    const ELASTIC_DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * {@inheritdoc}
     */
    protected $acceptedOptions = array(
        'field',
    );

    /**
     * The list of pre-defined dates to be used for the aggregation
     * @var array
     */
    protected $dateNames = array(
        'today',
        'yesterday',
        'tomorrow',
        'last_7_days',
        'next_7_days',
        'last_30_days',
        'next_30_days',
        'last_month',
        'this_month',
        'next_month',
        'last_year',
        'this_year',
        'next_year',
    );

    /**
     * Ctor
     */
    public function __construct()
    {
        // fixed ranges
        $this->options['ranges'] = $this->initRanges();
    }

    /**
     * {@inheritdoc}
     */
    public function buildMapping(Mapping $mapping, $field, array $defs)
    {
        $property = new MultiFieldProperty();
        $property->setType('date');
        $property->setMapping([
            'format' => 'YYYY-MM-dd HH:mm:ss',
            'store' => false,
        ]);
        $mapping->addCommonField($field, 'agg', $property);
    }

    /**
     * Creates range options for our Aggregation depending on current datetime.
     * @return array
     */
    protected function initRanges()
    {
        $ranges = array();
        foreach ($this->dateNames as $dateName) {
            $date = $this->parseDateRange($dateName);
            if (!empty($date)) {
                $from = $this->timestampToDate($date[0]->getTimestamp());
                $to =  $this->timestampToDate($date[1]->getTimestamp());

                // Here the date name is the id/key of the range
                $ranges[$dateName] = array(
                    'from' => $from,
                    'to' => $to,
                    'key' => $dateName
                );
            }
        }
        return $ranges;
    }

    /**
     * Parse date/time range into date based on user context
     * @param string $dateName
     * @return \DotbDateTime
     */
    protected function parseDateRange($dateName)
    {
        return \TimeDate::getInstance()->parseDateRange($dateName, $this->user);
    }

    /**
     * Convert timestamp to Datetime string
     * format: '2013-07-08 00:00:00'
     * @param $time
     * @return string
     */
    protected function timestampToDate($time)
    {
        return date(self::ELASTIC_DATETIME_FORMAT, $time);
    }
}
