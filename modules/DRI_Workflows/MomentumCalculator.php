<?php

namespace DRI_Workflows;

require_once "modules/DRI_SubWorkflows/MomentumCalculator.php";

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class MomentumCalculator
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
     * @throws \DRI_Workflows_Exception_IdNotFound
     * @throws \DotbApiExceptionError
     * @throws \DotbApiExceptionInvalidParameter
     */
    public function calculate()
    {
        $this->load();

        $this->journey->momentum_score = 0;
        $this->journey->momentum_points = 0;

        foreach ($this->stages as $stage) {
            $calculator = new \DRI_SubWorkflows\MomentumCalculator($stage);

            list($score, $total) = $calculator->calculate();

            if ($calculator->isMomentumChanged()) {
                $stage->save();
            }

            $this->journey->momentum_score += $score;
            $this->journey->momentum_points += $total;
        }

        $this->journey->momentum_ratio = $this->journey->momentum_points > 0
            ? $this->journey->momentum_score / $this->journey->momentum_points
            : 1;
    }
}
