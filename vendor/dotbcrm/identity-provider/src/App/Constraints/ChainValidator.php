<?php


namespace Dotbcrm\IdentityProvider\App\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ChainValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof All) {
            throw new UnexpectedTypeException($constraint, All::class);
        }

        if (null === $value) {
            return;
        }

        $context = $this->context;
        $validator = $context->getValidator()->inContext($context);
        $validator->validate($value, $constraint->constraints);
    }
}
