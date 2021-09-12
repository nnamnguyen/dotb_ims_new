<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see LanguageValidator
 *
 */
class Language extends Constraint
{
    const ERROR_LANGUAGE_NOT_FOUND = 1;

    protected static $errorNames = array(
        self::ERROR_LANGUAGE_NOT_FOUND => 'ERROR_LANGUAGE_NOT_FOUND',
    );

    public $message = 'Language name violation: %msg%';
}
