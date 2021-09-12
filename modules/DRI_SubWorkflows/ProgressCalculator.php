<?php

namespace DRI_SubWorkflows;

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class ProgressCalculator
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
     * @param \DRI_SubWorkflow $subWorkflow
     */
    public function __construct(\DRI_SubWorkflow $subWorkflow)
    {
        $this->stage = $subWorkflow;
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
     * @return array
     */
    public function calculate()
    {
        $this->load();

        $count = count($this->activities);

        $this->stage->points = 0;
        $this->stage->score = 0;

        foreach ($this->activities as $activity) {
            if ($activity->deleted) {
                $count--;
                continue;
            }
        }

        if ($count === 0) {
            $this->stage->progress = $this->stage->state === \DRI_SubWorkflow::STATE_COMPLETED ? 1 : 0;
            return array (0, 0);
        }

        foreach ($this->activities as $activity) {
            $handler = ActivityHandlerFactory::factory($activity->module_dir);
            $this->stage->points += $handler->getPoints($activity);
            $this->stage->score += $handler->getScore($activity);
        }

        $this->stage->progress = $this->stage->points > 0
            ? $this->stage->score / $this->stage->points
            : 0;

        return array($this->stage->score, $this->stage->points);
    }

    /**
     * @return bool
     */
    public function isProgressChanged()
    {
        return $this->stage->isFieldChanged('progress')
            || $this->stage->isFieldChanged('score')
            || $this->stage->isFieldChanged('points');
    }
}
