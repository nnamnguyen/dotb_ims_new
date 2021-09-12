<?php

namespace Dotbcrm\Dotbcrm\Audit\Formatter;

use Dotbcrm\Dotbcrm\Audit\Formatter;

/**
 * Class CompositeFormatter
 * Registry class for Audit Row Data Formatters
 * @package Dotbcrm\Dotbcrm\Audit\Formatter
 */
final class CompositeFormatter implements Formatter
{
    /**
     * @var Formatter[]
     */
    private $formatters = array();

    public function __construct(Formatter ...$formatters)
    {
        $this->formatters = $formatters;
    }

    /**
     * Itterates through all known formatters and runs them across the provided rows
     * @param array $rows
     */
    public function formatRows(array &$rows)
    {
        foreach ($this->formatters as $formatter) {
            $formatter->formatRows($rows);
        }
    }
}
