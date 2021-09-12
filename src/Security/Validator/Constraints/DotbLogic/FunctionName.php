<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints\DotbLogic;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see FunctionNameValidator
 *
 */
class FunctionName extends Constraint
{
    const ERROR_INVALID_FUNCTION_NAME = 1;

    protected static $errorNames = array(
        self::ERROR_INVALID_FUNCTION_NAME => 'ERROR_INVALID_FUNCTION_NAME',
    );

    public $message = 'Function name violation: %msg%';
}
