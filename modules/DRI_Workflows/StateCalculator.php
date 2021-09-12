<?php

namespace DRI_Workflows;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class StateCalculator
{
    /**
     * @var \DRI_Workflow
     */
    private $journey;

    /**
     * @var \DRI_SubWorkflow[]
     */
    private $stages;

    /**
     * StateCalculator constructor.
     * @param \DRI_Workflow $journey
     */
    public function __construct(\DRI_Workflow $journey)
    {
        $this->journey = $journey;
    }

    /**
     * @param \DRI_SubWorkflow[] $stages
     */
    public function setStages(array $stages)
    {
        $this->stages = $stages;
    }

    /**
     *
     */
    public function load()
    {
        if (null === $this->stages) {
            $this->stages = $this->journey->getStages();
        }
    }

    /**
     * @param bool $save
     */
    public function calculate($save = true)
    {
        // Since the sub workflows are dependant on each other both forward and backwards in the chain,
        // we need to calculate the state twice in order to set the states properly.
        // This is not a optimal solution though but works for now.
        $this->calculateStageStates($save);
        $this->calculateStageStates($save);

        $this->journey->state = $this->getState();
    }

    /**
     * @param bool $save
     */
    public function calculateStageStates($save = true)
    {
        $this->load();

        foreach ($this->stages as $stage) {
            $calculator = $this->calculateStageState($stage);

            if ($save && $calculator->isStateChanged()) {
                $stage->save();
            }
        }
    }

    /**
     * @param $stage
     * @return \DRI_SubWorkflows\StateCalculator
     */
    private function calculateStageState($stage)
    {
        $calculator = new \DRI_SubWorkflows\StateCalculator($stage);
        $calculator->calculate();

        return $calculator;
    }

    /**
     * @return string
     */
    public function getState()
    {
        $this->load();

        $count = count($this->stages);
        $notStarted = 0;
        $completed = 0;

        foreach ($this->stages as $stage) {
            switch ($stage->state) {
                case \DRI_SubWorkflow::STATE_COMPLETED:
                    $completed++;
                    break;
                case \DRI_SubWorkflow::STATE_NOT_STARTED:
                    $notStarted++;
                    break;
            }
        }

        if ($completed === $count) {
            return \DRI_Workflow::STATE_COMPLETED;
        }

        if ($notStarted === $count) {
            return \DRI_Workflow::STATE_NOT_STARTED;
        }

        return \DRI_Workflow::STATE_IN_PROGRESS;
    }
}
