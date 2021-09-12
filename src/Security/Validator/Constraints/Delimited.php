<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Constraints as Assert;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueTrait;

/**
 *
 * @see DelimitedValidator
 *
 */
class Delimited extends All implements ConstraintReturnValueInterface
{
    use ConstraintReturnValueTrait;

    public $delimiter = ',';

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

        // Validate delimiter format
        if (!is_string($this->delimiter) || empty($this->delimiter)) {
            throw new ConstraintDefinitionException('Delimiter is expected to be a string');
        }
    }
}
