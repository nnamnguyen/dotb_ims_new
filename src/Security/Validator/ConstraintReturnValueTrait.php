<?php


namespace Dotbcrm\Dotbcrm\Security\Validator;

use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueInterface;

/**
 *
 * @see ConstraintReturnValueInterface
 *
 */
trait ConstraintReturnValueTrait
{
    /**
     * @var mixed
     */
    protected $formattedReturnValue;

    /**
     * Get formatted validated return value
     *
     * @return mixed Formatted return value
     */
    public function getFormattedReturnValue()
    {
        return $this->formattedReturnValue;
    }

    /**
     * Set formatted validated return value
     *
     * @param mixed $value Formatted return value
     */
    public function setFormattedReturnValue($value)
    {
        $this->formattedReturnValue = $value;
    }
}
