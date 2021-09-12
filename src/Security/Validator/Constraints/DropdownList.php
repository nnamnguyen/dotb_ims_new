<?php

namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see DropdownListValidator
 *
 */
class DropdownList extends Constraint
{
    const ERROR_INVALID_DROPDOWN_KEY = 1;
    protected static $errorNames = array(
        self::ERROR_INVALID_DROPDOWN_KEY => 'ML_LANGUAGE_FILE_KEYS_INVALID',
    );
    public $message = 'Dropdown list violation: %msg%';
}
