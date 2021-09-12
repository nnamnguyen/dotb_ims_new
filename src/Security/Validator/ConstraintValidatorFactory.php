<?php


namespace Dotbcrm\Dotbcrm\Security\Validator;

use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
use Symfony\Component\Validator\Constraint;

/**
 *
 * ConstraintValidator Factory
 *
 */
class ConstraintValidatorFactory implements ConstraintValidatorFactoryInterface
{
    /**
     * @var ConstraintValidator[]
     */
    protected $validators = array();

    /**
     * {@inheritdoc}
     */
    public function getInstance(Constraint $constraint)
    {
        $className = $constraint->validatedBy();

        if (!isset($this->validators[$className])) {
            $this->validators[$className] = new $className();
        }

        return $this->validators[$className];
    }

    /**
     * Clear validators cache
     */
    public function clearValidatorsCache()
    {
        $this->validators = [];
    }
}
