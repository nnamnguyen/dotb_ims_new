<?php

namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * Advanced Workflow subject
 */
final class AdvancedWorkflow extends Bean
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $parent = parent::jsonSerialize();
        $child = ['_type' => 'advanced-workflow'];
        return array_merge($parent, $child);
    }
}
