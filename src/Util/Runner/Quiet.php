<?php


namespace Dotbcrm\Dotbcrm\Util\Runner;

/**
 * Quiet runner for execution action on list of beans.
 *
 * Class Quiet
 * @package Dotbcrm\Dotbcrm\Util\Runner
 */
class Quiet
{
    /**
     * @var RunnableInterface
     */
    protected $runnable;

    /**
     * Quiet runner constructor.
     *
     * @param RunnableInterface $runnable
     */
    public function __construct(RunnableInterface $runnable)
    {
        $this->runnable = $runnable;
    }

    /**
     * Iteration by beans and execution action each bean.
     */
    public function run()
    {
        set_time_limit(0);
        foreach ($this->runnable->getBeans() as $bean) {
            $this->runnable->execute($bean);
        }
    }
}
