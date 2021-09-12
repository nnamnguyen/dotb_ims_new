<?php

namespace Dotbcrm\Dotbcrm\Audit\Formatter;

use Dotbcrm\Dotbcrm\Audit\Formatter;

class Date implements Formatter
{
    private $timedate;

    public function __construct(\TimeDate $timedate = null)
    {
        $this->timedate = $timedate ?: \TimeDate::getInstance();
    }

    public function formatRows(array &$rows)
    {
        array_walk($rows, function (&$row) {
            if (in_array($row['data_type'], ['date', 'datetime'])) {
                $row['before'] = $this->formatDateTime($row['before'], $row['data_type']);
                $row['after'] = $this->formatDateTime($row['after'], $row['data_type']);
            }
        });
    }

    private function formatDateTime($value, $type)
    {
        if ($value) {
            $obj = $this->timedate->fromDbType($value, $type);
            $value = $this->timedate->asIso($obj);
        }

        return $value;
    }
}
