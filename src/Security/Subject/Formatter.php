<?php


namespace Dotbcrm\Dotbcrm\Security\Subject;

/**
 * Formats a set of serialized security subjects
 */
interface Formatter
{
    /**
     * Formats a set of subjects
     *
     * @param array[][] $subjects
     * @return array[][]
     */
    public function formatBatch(array $subjects);
}
