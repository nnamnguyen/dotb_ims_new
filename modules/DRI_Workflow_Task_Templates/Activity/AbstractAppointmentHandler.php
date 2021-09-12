<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Abstract implementation for all appointment activities (Meeting/Call)
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
abstract class AbstractAppointmentHandler extends AbstractActivityHandler
{
    const STATUS_PLANNED = 'Planned';
    const STATUS_HELD = 'Held';
    const STATUS_NOT_HELD = 'Not Held';

    /**
     * {@inheritdoc}
     */
    public function getNotStartedStatus()
    {
        return static::STATUS_PLANNED;
    }

    /**
     * {@inheritdoc}
     */
    public function getInProgressStatus()
    {
        return static::STATUS_PLANNED;
    }

    /**
     * {@inheritdoc}
     */
    public function getCompletedStatus()
    {
        return static::STATUS_HELD;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotApplicableStatus()
    {
        return static::STATUS_NOT_HELD;
    }

    /**
     * {@inheritdoc}
     */
    public function isInProgress(\DotbBean $activity)
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isNotStarted(\DotbBean $activity)
    {
        return $activity->status === self::STATUS_PLANNED;
    }

    /**
     * {@inheritdoc}
     */
    public function isNotApplicable(\DotbBean $activity)
    {
        return $activity->status === self::STATUS_NOT_HELD;
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromTemplate(\DotbBean $activity, \DRI_Workflow_Task_Template $template)
    {
        $timeDate = \TimeDate::getInstance();

        /** @var \Meeting $activity */
        parent::populateFromTemplate($activity, $template);

        $activity->status = self::STATUS_PLANNED;
        $activity->send_invites = $template->send_invites === \DRI_Workflow_Task_Template::SEND_INVITES_CREATE;

        switch ($template->task_due_date_type) {
            case \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_CREATED:
                $this->createDates(
                    $template,
                    $activity,
                    $timeDate->getNow()
                );
                break;
            case \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_PARENT_DATE_FIELD:
                $this->setDueDateFromParentField($activity);
                break;
            default:
                // default to a "empty" start date, we always needs to
                // set a start date for calls/meetings since this field is required
                $this->setDates(
                    $template,
                    $activity,
                    $this->getEmptyStartDate()
                );
        }

        switch ($template->momentum_start_type) {
            case \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_CREATED:
                $activity->cj_momentum_start_date = $timeDate->asUser($timeDate->getNow());
                break;
            case \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_PARENT_DATE_FIELD:
                $this->setMomentumStartDateFromParentField($activity);
                break;
        }
    }

    /**
     * @param \DotbBean $activity
     * @throws \DRI_Workflows_Exception_IdNotFound
     * @throws \DRI_Workflows_Exception_ParentNotFound
     */
    public function setMomentumStartDateFromParentField(\DotbBean $activity)
    {
        if (!$this->hasActivityTemplate($activity)) {
            return;
        }

        $timeDate = \TimeDate::getInstance();
        $template = $this->getActivityTemplate($activity);
        $date = $this->getMomentumStartDateFromParentField($activity, $template);

        if (!empty($date)) {
            $activity->cj_momentum_start_date = $timeDate->asUser($date);
        }
    }

    /**
     * @param \DotbBean $activity
     */
    public function setDueDateFromParentField(\DotbBean $activity)
    {
        if (!$this->hasActivityTemplate($activity)) {
            return;
        }

        $template = $this->getActivityTemplate($activity);
        $date = $this->getDueDateFromParentField($activity, $template);

        if (!empty($date)) {
            $this->createDates($template, $activity, $date);
        }
    }

    /**
     * Invites the parent Contact/Lead to Meeting/Call
     *
     * {@inheritdoc}
     */
    public function afterCreate(\DotbBean $activity, \DotbBean $parent)
    {
        parent::afterCreate($activity, $parent);

        if ($parent->module_dir === 'Contacts') {
            $activity->load_relationship('contacts');
            $activity->contacts->add($parent->id);
        } elseif ($parent->module_dir === 'Leads') {
            $activity->load_relationship('leads');
            $activity->leads->add($parent->id);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function start(\DotbBean $activity)
    {
        $timeDate = \TimeDate::getInstance();

        /** @var \Meeting $activity */
        $save = parent::start($activity);

        if ($this->hasActivityTemplate($activity)) {
            $template = $this->getActivityTemplate($activity);

            if ($template->send_invites === \DRI_Workflow_Task_Template::SEND_INVITES_STAGE_START) {
                $activity->send_invites = true;
                $save = true;
            }

            switch ($template->task_due_date_type) {
                case \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_STAGE_STARTED:
                    if ($this->isEmptyStartDate($activity)) {
                        $this->createDates(
                            $template,
                            $activity,
                            $timeDate->getNow()
                        );
                        $save = true;
                    }

                    break;
            }

            switch ($template->momentum_start_type) {
                case \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_STAGE_STARTED:
                    $activity->cj_momentum_start_date = $timeDate->asUser($timeDate->getNow());
                    break;
            }
        }

        return $save;
    }

    /**
     * {@inheritdoc}
     */
    public function previousActivityCompleted(\DotbBean $activity, \DotbBean $previous)
    {
        $timeDate = \TimeDate::getInstance();

        if ($this->hasActivityTemplate($activity)) {
            /** @var \Meeting|\Call $activity */
            $stage = $this->getStage($activity);
            $template = $this->getActivityTemplate($activity);

            if ($template->task_due_date_type === \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_PREVIOUS_ACTIVITY_COMPLETED
                    && $this->isEmptyStartDate($activity)) {
                $this->createDates(
                    $template,
                    $activity,
                    $timeDate->getNow()
                );
                $activity->save();
            }

            if ($template->momentum_start_type === \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_PREVIOUS_ACTIVITY_COMPLETED) {
                $activity->cj_momentum_start_date = $timeDate->asUser($timeDate->getNow());
                $activity->save();
            }

            if ($template->getAssigneeRule($stage) === \DRI_Workflow_Task_Template::ASSIGNEE_RULE_PREVIOUS_ACTIVITY_COMPLETED) {
                $parent = $stage->getParent();

                if (empty($activity->assigned_user_id)) {
                    $activity->assigned_user_id = $this->getTargetAssigneeId($stage, $template, $activity, $parent);
                }

                $activity->team_id = $this->getTargetTeamId($stage, $template, $parent);
                $activity->team_set_id = $this->getTargetTeamSetId($stage, $template, $parent);
                $activity->save();
            }
        }
    }

    /**
     * Checks if the start date is a "empty" start date
     *
     * @param \DotbBean $activity
     * @return bool
     */
    private function isEmptyStartDate(\DotbBean $activity)
    {
        $timeDate = \TimeDate::getInstance();

        if (empty($activity->date_start)) {
            return true;
        }

        $date = $timeDate->fromUser($activity->date_start);

        if (!$date) {
            $date = $timeDate->fromDb($activity->date_start);
        }

        return $timeDate->asDb($date) === $timeDate->asDb($this->getEmptyStartDate());
    }

    /**
     * The empty start date for calls/meetings is a date far ahead in the future
     *
     * @return \DateTime
     */
    private function getEmptyStartDate()
    {
        return new \DotbDateTime('2100-01-01 12:00:00');
    }

    /**
     * @param \DRI_Workflow_Task_Template $template
     * @param \DotbBean $bean
     * @param \DateTime $date
     */
    private function createDates(\DRI_Workflow_Task_Template $template, \DotbBean $bean, \DateTime $date)
    {
        $timeDate = \TimeDate::getInstance();
        $startDate = clone $date;

        // set correct timezone
        $timeDate->tzUser($startDate);

        // add the days
        if ($template->task_due_days > 0) {
            $startDate->modify(sprintf('+ %d days', $template->task_due_days));
        } else {
            $startDate->modify(sprintf('- %d days', -$template->task_due_days));
        }

        // set time
        list($hour, $minute) = explode(':', $template->time_of_day);
        $startDate->setTime((int)$hour, (int)$minute, 0);

        $this->setDates($template, $bean, $startDate);
    }

    /**
     * @param \DRI_Workflow_Task_Template $template
     * @param \DotbBean $bean
     * @param $startDate
     */
    private function setDates(\DRI_Workflow_Task_Template $template, \DotbBean $bean, \DateTime $startDate)
    {
        $timeDate = \TimeDate::getInstance();

        // create end date
        $endDate = clone $startDate;

        // add duration hours
        $durationHours = (int)$template->duration_hours;
        if ($durationHours > 0) {
            $endDate->modify(sprintf('+ %s hours', $durationHours));
        }

        // add duration minutes
        $durationMinutes = (int)$template->duration_minutes;
        if ($durationMinutes > 0) {
            $endDate->modify(sprintf('+ %s minutes', $durationMinutes));
        }

        // format and populate data
        $bean->date_start = $timeDate->asUser($startDate);
        $bean->date_end = $timeDate->asUser($endDate);
        $bean->duration_hours = $template->duration_hours;
        $bean->duration_minutes = $template->duration_minutes;
    }
}
