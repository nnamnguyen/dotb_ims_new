<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Base field evaluator object. At its core, this is a plain text field handler.
 * @package ProcessManager
 */
class Base extends AbstractEvaluator implements EvaluatorInterface
{
    /**
     * @inheritDoc
     */
    public function hasChanged()
    {
        if ($this->isCheckable()) {
            return $this->data[$this->name] !== $this->bean->{$this->name};
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty()
    {
        // It can only be empty if it actually is on the bean
        if (!$this->hasProperty()) {
            return false;
        }

        // Logic is basically, if the field value is null or an empty string, it
        // is empty
        return $this->bean->{$this->name} === null
               || $this->getTrimmedValue() === '';
    }

    /**
     * Gets a trimmed version of the data on the bean. Assumed the bean has
     * already checked if this field is present.
     * @return string
     */
    protected function getTrimmedValue()
    {
        return trim($this->bean->{$this->name});
    }
}
