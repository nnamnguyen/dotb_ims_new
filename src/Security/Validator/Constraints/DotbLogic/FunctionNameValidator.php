<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints\DotbLogic;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 *
 * DotbLogic function name validator
 *
 */
class FunctionNameValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof FunctionName) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\ComponentName');
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string)$value;

        // check for invalid characters. Regex pulled from expressions.js
        if (!preg_match('/^[\w\-]*$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter(
                    '%msg%',
                    'must only use word characters and -'
                )
                ->setInvalidValue($value)
                ->setCode(FunctionName::ERROR_INVALID_FUNCTION_NAME)
                ->addViolation();

            return;
        }
    }
}
