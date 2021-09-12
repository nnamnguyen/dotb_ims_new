<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Integer evaluator object.
 * @package ProcessManager
 */
class Integer extends Base implements EvaluatorInterface
{
    /**
     * @inheritDoc
     */
    public function hasChanged()
    {
        if ($this->isCheckable()) {
            return $this->data[$this->name] !== intval($this->bean->{$this->name});
        }

        return false;
    }
}
