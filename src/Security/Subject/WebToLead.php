<?php

namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * WebToLead subject
 */
final class WebToLead implements Subject
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'web-to-lead',
        ];
    }
}
