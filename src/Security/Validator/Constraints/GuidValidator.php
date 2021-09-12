<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 *
 * GUID validator
 *
 */
class GuidValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Guid) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Guid');
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        // check for allowed characters
        if (!preg_match('/^[a-z0-9\-_]*$/i', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%msg%', 'invalid format')
                ->setInvalidValue($value)
                ->setCode(Guid::ERROR_INVALID_FORMAT)
                ->addViolation();
            return;
        }
    }
}
