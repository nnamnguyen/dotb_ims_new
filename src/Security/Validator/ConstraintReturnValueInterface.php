<?php


namespace Dotbcrm\Dotbcrm\Security\Validator;

/**
 *
 * Validator constraints are used to only validate given values and are reused
 * during the validation process. In some cases it makes sense that a validator
 * returns a formatted value to avoid any duplicate operations further down
 * the logic chain.
 *
 * With this interface it is possible to set such value from the validator
 * back to the constraint.
 *
 */
interface ConstraintReturnValueInterface
{
    /**
     * Get formatted validated return value
     * @return mixed Formatted return value
     */
    public function getFormattedReturnValue();

    /**
     * Set formatted validated return value
     * @param mixed $value Formatted return value
     */
    public function setFormattedReturnValue($value);
}
