<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Field evaluator interface
 * @package ProcessManager
 */
interface EvaluatorInterface
{
    /**
     * Checks to see if the field has changed
     * @return boolean
     */
    public function hasChanged();

    /**
     * Checks to see if the field contains an empty value
     * @return boolean
     */
    public function isEmpty();
}
