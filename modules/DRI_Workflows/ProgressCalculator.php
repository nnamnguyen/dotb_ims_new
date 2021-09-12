<?php

namespace DRI_Workflows;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class ProgressCalculator
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
     * @throws \DRI_Workflows_Exception_IdNotFound
     * @throws \DotbApiExceptionError
     * @throws \DotbApiExceptionInvalidParameter
     */
    public function calculate($save = true)
    {
        $this->load();

        $this->journey->score = 0;
        $this->journey->points = 0;

        foreach ($this->stages as $stage) {
            $calculator = new \DRI_SubWorkflows\ProgressCalculator($stage);

            list($score, $total) = $calculator->calculate();

            if ($save && $calculator->isProgressChanged()) {
                $stage->save();
            }

            $this->journey->score += $score;
            $this->journey->points += $total;
        }

        $this->journey->progress = $this->journey->points > 0
            ? floor(($this->journey->score / $this->journey->points) * 100) / 100
            : 1;
    }
}
