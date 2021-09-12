<?php



namespace Dotbcrm\Dotbcrm\Util\Runner;

/**
 * Interface of Executer for runners.
 *
 * Interface RunnableInterface
 * @package Dotbcrm\Dotbcrm\Util\Runner
 */
interface RunnableInterface
{
    /**
     * Return traversable list of bean for running.
     *
     * @return \Traversable
     */
    public function getBeans();

    /**
     * Do action by one bean.
     *
     * @param \DotbBean $bean
     */
    public function execute(\DotbBean $bean);
}
