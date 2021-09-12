<?php


namespace Dotbcrm\Dotbcrm\Security\Subject;

/**
 * CronJob subject
 */
final class CronJob extends Bean
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $parent = parent::jsonSerialize();
        $child = ['_type' => 'cron-job'];
        return array_merge($parent, $child);
    }
}
