<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints as Assert;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueTrait;

/**
 *
 * @see ArrayRecursiveValidator
 *
 */
class ArrayRecursive extends All implements ConstraintReturnValueInterface
{
    use ConstraintReturnValueTrait;

    /**
     * {@inheritdoc}
     */
    public function __construct($options = null)
    {
        // If no constraints are explicitly defined we assume string constraint
        if (is_array($options) && empty($options['constraints'])) {
            $options['constraints'] = new Assert\Type(array('type' => 'scalar'));
        }

        parent::__construct($options);
    }
}
