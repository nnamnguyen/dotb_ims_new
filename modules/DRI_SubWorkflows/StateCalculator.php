<?php

namespace DRI_SubWorkflows;

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class StateCalculator
{
    /**
     * @var \DRI_SubWorkflow
     */
    private $stage;

    /**
     * @var \DotbBean[]
     */
    private $activities;

    /**
     * StateCalculator constructor.
     * @param \DRI_SubWorkflow $stage
     */
    public function __construct(\DRI_SubWorkflow $stage)
    {
        $this->stage = $stage;
    }

    /**
     *
     */
    public function load()
    {
        if (null === $this->activities) {
            $this->activities = $this->stage->getActivities();
        }
    }

    /**
     *
     */
    public function calculate()
    {
        $this->stage->state = $this->getState();
    }

    /**
     * @return bool
     */
    public function isStateChanged()
    {
        return $this->stage->isFieldChanged('state');
    }

    /**
     * @return string
     */
    public function getState()
    {
        $this->load();

        $count = count($this->activities);
        $notStarted = 0;
        $completed = 0;

        foreach ($this->activities as $activity) {
            if ($activity->deleted) {
                $count--;
                continue;
            }
        }

        if ($count === 0) {
            return $this->noActivities();
        }

        foreach ($this->activities as $activity) {
            $activityHandler = ActivityHandlerFactory::factory($activity->module_dir);

            if ($activityHandler->isNotStarted($activity)) {
                $notStarted++;
            } elseif ($activityHandler->isCompleted($activity)) {
                $completed++;
            }
        }

        if ($completed === $count) {
            return $this->completed();
        }

        if ($notStarted === $count) {
            return $this->notStarted();
        }

        if ($this->stage->hasStartedLaterStages()) {
            return \DRI_SubWorkflow::STATE_NOT_COMPLETED;
        }

        return \DRI_SubWorkflow::STATE_IN_PROGRESS;
    }

    /**
     * @return string
     */
    protected function noActivities()
    {
        if ($this->stage->isLastStage()) {
            if ($this->stage->isAllPreviousStagesCompleted()) {
                return \DRI_SubWorkflow::STATE_COMPLETED;
            }

            return \DRI_SubWorkflow::STATE_NOT_STARTED;
        }

        if ($this->stage->isNextStageStarted()) {
            if ($this->stage->isAllPreviousStagesCompleted()) {
                return \DRI_SubWorkflow::STATE_COMPLETED;
            }

            return \DRI_SubWorkflow::STATE_NOT_COMPLETED;
        }

        if ($this->stage->isFirstStage()) {
            return \DRI_SubWorkflow::STATE_IN_PROGRESS;
        }

        if ($this->stage->isAllPreviousStagesCompleted()) {
            return \DRI_SubWorkflow::STATE_COMPLETED;
        }

        return \DRI_SubWorkflow::STATE_NOT_STARTED;
    }

    /**
     * @return string
     */
    protected function notStarted()
    {
        if ($this->stage->hasStartedLaterStages()) {
            return \DRI_SubWorkflow::STATE_NOT_COMPLETED;
        }

        if ($this->stage->isAllPreviousStagesCompleted() || $this->stage->isFirstStage()) {
            return \DRI_SubWorkflow::STATE_IN_PROGRESS;
        }

        return \DRI_SubWorkflow::STATE_NOT_STARTED;
    }

    /**
     * @return string
     */
    protected function completed()
    {
        return \DRI_SubWorkflow::STATE_COMPLETED;
    }
}
