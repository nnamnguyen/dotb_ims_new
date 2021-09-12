<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see GuidValidator
 *
 */
class Guid extends Constraint
{
    const ERROR_INVALID_FORMAT = 1;

    protected static $errorNames = array(
        self::ERROR_INVALID_FORMAT => 'ERROR_INVALID_FORMAT',
    );

    public $message = 'GUID violation: %msg%';
}
