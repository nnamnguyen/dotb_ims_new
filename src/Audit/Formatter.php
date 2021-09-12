<?php

namespace Dotbcrm\Dotbcrm\Audit;

interface Formatter
{
    /**
     * Applies this formatter to all applicable rows
     * @param array $rows
     *
     * @return null
     */
    public function formatRows(array &$rows);
}
