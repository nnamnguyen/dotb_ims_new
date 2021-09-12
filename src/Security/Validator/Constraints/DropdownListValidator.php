<?php

namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 *
 * Dropdown list validator
 *
 */
class DropdownListValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($dropdownList, Constraint $constraint)
    {
        if (!$constraint instanceof DropdownList) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\DropdownList');
        }
        if (empty($dropdownList)) {
            $dropdownList = array();
        }
        if (!is_array($dropdownList)) {
            throw new UnexpectedTypeException($dropdownList, 'array');
        }
        if (!$this->checkArrayKeysValidityRecursively($dropdownList)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter(
                    '%msg%',
                    'may only consist of letters, numbers and underscores.'
                )
                ->setInvalidValue($dropdownList)
                ->setCode(DropdownList::ERROR_INVALID_DROPDOWN_KEY)
                ->addViolation();
            return;
        }
    }
    /**
     * Checks array keys validity (contains only letters, numbers and underscore)
     * @param array $array
     * @return bool true if all array keys are valid.
     */
    private function checkArrayKeysValidityRecursively($array)
    {
        foreach ($array as $key => $value) {
            // allow white spaces in middle
            $keyValid = preg_match('/^[a-zA-Z\_0-9]+(\s+[a-zA-Z\_0-9]+)*$/', $key) || $key == '';
            if (!$keyValid || (is_array($value) && !$this->checkArrayKeysValidityRecursively($value))) {
                return false;
            }
        }
        return true;
    }
}
