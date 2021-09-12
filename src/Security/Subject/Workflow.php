<?php

namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * Dotb Workflow subject
 */
final class Workflow extends Bean
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $parent = parent::jsonSerialize();
        $child = ['_type' => 'workflow'];
        return array_merge($parent, $child);
    }
}
