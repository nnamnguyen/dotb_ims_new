<?php

namespace DRI_SubWorkflows;

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class MomentumCalculator
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

        $this->stage->momentum_points = 0;
        $this->stage->momentum_score = 0;

        foreach ($this->activities as $activity) {
            if ($activity->deleted) {
                $count--;
                continue;
            }
        }

        foreach ($this->activities as $activity) {
            $handler = ActivityHandlerFactory::factory($activity->module_dir);
            $this->stage->momentum_points += $handler->getMomentumPoints($activity);
            $this->stage->momentum_score += $handler->getMomentumScore($activity);
        }

        $this->stage->momentum_ratio = $this->stage->momentum_points > 0
            ? $this->stage->momentum_score / $this->stage->momentum_points
            : 1;

        return array($this->stage->momentum_score, $this->stage->momentum_points);
    }

    /**
     * @return bool
     */
    public function isMomentumChanged()
    {
        return $this->stage->isFieldChanged('momentum_points')
            || $this->stage->isFieldChanged('momentum_score')
            || $this->stage->isFieldChanged('momentum_ratio');
    }
}
