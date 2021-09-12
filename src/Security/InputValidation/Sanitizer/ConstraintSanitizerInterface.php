<?php


namespace Dotbcrm\Dotbcrm\Security\InputValidation\Sanitizer;

/**
 *
 * Ability to add additional sanitizing on validator constraints. Although this
 * option exists its encouraged to perform validation and report a violation
 * instead of sanitizing the user input.
 *
 */
interface ConstraintSanitizerInterface
{
    /**
     * Sanitize the given value. Sanitizing happens before the validation.
     *
     * @param mixed $value Raw value
     * @return mixed Sanitzed string value
     */
    public function sanitize($value);
}
