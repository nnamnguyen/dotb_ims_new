<?php


/**
 * Helper component for formatting dates on BWC views
 */
class ViewDateFormatter
{
    /**
     * Formats a value of a given type from DB format to the user-preferred one
     *
     * @param string $type Field type
     * @param mixed $value DB-formatted value
     * @return string
     */
    public static function format(string $type, $value)
    {
        $timeDate = TimeDate::getInstance();

        switch ($type) {
            case 'date':
                if ($timeDate->check_matching_format($value, TimeDate::DB_DATE_FORMAT)) {
                    $dateTime = $timeDate->fromDbDate($value);
                    $value = $timeDate->asUserDate($dateTime);
                }

                break;

            case 'datetime':
            case 'datetimecombo':
                if ($timeDate->check_matching_format($value, TimeDate::DB_DATETIME_FORMAT)) {
                    $dateTime = $timeDate->fromDb($value);
                    $value = $timeDate->asUser($dateTime);
                }

                break;
        }

        return $value;
    }
}
