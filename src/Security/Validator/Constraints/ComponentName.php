<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see ComponentNameValidator
 *
 */
class ComponentName extends Constraint
{
    const ERROR_INVALID_COMPONENT_NAME = 1;
    const ERROR_RESERVED_KEYWORD = 2;

    protected static $errorNames = array(
        self::ERROR_INVALID_COMPONENT_NAME => 'ERROR_INVALID_COMPONENT_NAME',
        self::ERROR_RESERVED_KEYWORD => 'ERROR_RESERVED_KEYWORD',
    );

    public $message = 'Component name violation: %msg%';

    /**
     * Are sql reserved words allowed?
     * @var bool
     */
    public $allowReservedSqlKeywords = true;
}
