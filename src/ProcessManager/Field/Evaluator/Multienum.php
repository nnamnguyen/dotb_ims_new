<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Multi select evaluator object. Handles evaluation of multienum fields.
 * @package ProcessManager
 */
class Multienum extends Base implements EvaluatorInterface
{
    /**
     * @inheritDoc
     */
    public function hasChanged()
    {
        if ($this->isCheckable()) {
            // Get what is on the bean as an array
            $beanValues = unencodeMultienum($this->bean->{$this->name});

            // The data sent should already be an array, but cast it for safety's
            // sake
            $dataValues = (array) $this->data[$this->name];

            // Lets calculate some diffs, shall we?
            $diff1 = array_diff($beanValues, $dataValues);
            $diff2 = array_diff($dataValues, $beanValues);

            // If either of the diffs are not empty then there was a change
            return !empty($diff1) || !empty($diff2);
        }

        return false;
    }
}
