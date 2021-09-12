<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Top implementation of the Call Activity Handler
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class CallHandler extends AbstractAppointmentHandler
{
    /**
     * @var string
     */
    protected $linkName = 'calls';

    /**
     * @var string
     */
    protected $moduleName = 'Calls';

    /**
     * {@inheritdoc}
     */
    public function populateFromTemplate(\DotbBean $activity, \DRI_Workflow_Task_Template $template)
    {
        parent::populateFromTemplate($activity, $template);
        $activity->direction = $template->direction;
    }

    /**
     * {@inheritdoc}
     */
    public function isCompleted(\DotbBean $activity)
    {
        return isset($GLOBALS['app_list_strings']['cj_calls_completed_status_list'][$activity->status]);
    }
}
