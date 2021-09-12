<?php


namespace Dotbcrm\Dotbcrm\Util\Runner;

/**
 * Dot runner for execution action on list of beans.
 *
 * Class Doc
 * @package Dotbcrm\Dotbcrm\Util\Runner
 */
class Dot
{
    /**
     * @var RunnableInterface
     */
    protected $runnable;

    /**
     * Dot runner constructor.
     *
     * @param RunnableInterface $runnable
     */
    public function __construct(RunnableInterface $runnable)
    {
        $this->runnable = $runnable;
    }

    /**
     * Iteration by beans and echo dot for each execution.
     */
    public function run()
    {
        set_time_limit(0);
        foreach ($this->runnable->getBeans() as $bean) {
            $this->runnable->execute($bean);
            echo '. ';
            flush();
        }
    }
}
