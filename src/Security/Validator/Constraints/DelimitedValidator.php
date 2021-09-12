<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\AllValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 *
 * Delimited Validator using CSV format (@see `str_getcsv`). The supplied
 * constraints are applied to every column in the string.
 *
 */
class DelimitedValidator extends AllValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Delimited) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Delimited');
        }

        if (null === $value || '' === $value) {
            $constraint->setFormattedReturnValue(array());
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        // parse string into array
        $array = explode($constraint->delimiter, $value);

        $context = $this->context;
        $validator = $context->getValidator()->inContext($context);

        foreach ($array as $key => $element) {
            $validator->atPath('['.$key.']')->validate($element, $constraint->constraints);
        }

        $constraint->setFormattedReturnValue($array);
    }
}
