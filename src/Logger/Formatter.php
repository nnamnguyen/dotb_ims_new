<?php


namespace Dotbcrm\Dotbcrm\Logger;

use Monolog\Formatter\LineFormatter;

/**
 * DotbLogger-compatible log formatter
 */
class Formatter extends LineFormatter
{
    /**
     * Constructor
     *
     * @param string $dateFormat Date format
     */
    public function __construct($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        global $current_user;

        if (!empty($current_user->id)) {
            $userId = $current_user->id;
        } else {
            $userId = '-none-';
        }

        return strftime($this->dateFormat)
            . ' '
            . '[' . getmypid() . ']'
            . '[' . $userId . ']'
            . '[' . strtoupper($record['level_name']) . ']'
            . ' '
            . $this->stringify($record['message'])
            . "\n";
    }

    /**
     * {@inheritdoc}
     */
    protected function replaceNewlines($str)
    {
        if ($this->allowInlineLineBreaks) {
            return $str;
        }

        return str_replace(array("\r", "\n"), array('\r', '\n'), $str);
    }
}
