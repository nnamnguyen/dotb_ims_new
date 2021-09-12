<?php


namespace Dotbcrm\Dotbcrm\Logger\Formatter;

use Dotbcrm\Dotbcrm\Logger\Formatter;

/**
 * Formatter for backward compatibility with legacy error levels
 *
 * In case if the message contains legacy level name, it restores the original message
 * and replaces the PSR level with the legacy one
 */
class BackwardCompatibleFormatter extends Formatter
{
    /**
     * {@inheritdoc}
     *
     * @see DotbPsrLogger::log()
     */
    public function format(array $record)
    {
        $record['message'] = preg_replace_callback('/^\[LEVEL:([^\]]+)\] (.*)/', function ($matches) use (&$record) {
            $record['level_name'] = $matches[1];
            return $matches[2];
        }, $record['message']);

        return parent::format($record);
    }
}
