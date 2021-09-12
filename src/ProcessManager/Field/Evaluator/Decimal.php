<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Decimal field evaluator object. This should not be confused with the Float
 * field type, as floats are treated as strings across the board, while decimal
 * fields are treated like Int fields, except as a floating point value.
 * @package ProcessManager
 */
class Decimal extends Base implements EvaluatorInterface
{
    /**
     * @inheritDoc
     */
    public function hasChanged()
    {
        if ($this->isCheckable()) {
            return $this->data[$this->name] !== floatval($this->bean->{$this->name});
        }

        return false;
    }
}
