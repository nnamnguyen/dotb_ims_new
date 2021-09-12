<?php

namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * Installer subject
 */
final class Installer implements Subject
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'installer',
        ];
    }
}
