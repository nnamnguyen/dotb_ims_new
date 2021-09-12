<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Top implementation of the Meeting Activity Handler
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class MeetingHandler extends AbstractAppointmentHandler
{
    /**
     * @var string
     */
    protected $linkName = 'meetings';

    /**
     * @var string
     */
    protected $moduleName = 'Meetings';

    /**
     * {@inheritdoc}
     */
    public function isCompleted(\DotbBean $activity)
    {
        return isset($GLOBALS['app_list_strings']['cj_meetings_completed_status_list'][$activity->status]);
    }
}
