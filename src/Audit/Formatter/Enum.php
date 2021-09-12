<?php


namespace Dotbcrm\Dotbcrm\Audit\Formatter;

use Dotbcrm\Dotbcrm\Audit\Formatter;

class Enum implements Formatter
{

    public function formatRows(array &$rows)
    {
        array_walk($rows, function (&$row) {
            if (in_array($row['data_type'], ['enum', 'multienum'])) {
                if (!is_null($row['before'])) {
                    $row['before'] = explode(',', str_replace('^', '', $row['before']));
                }
                if (!is_null($row['after'])) {
                    $row['after'] = explode(',', str_replace('^', '', $row['after']));
                }
            }
        });
    }
}
