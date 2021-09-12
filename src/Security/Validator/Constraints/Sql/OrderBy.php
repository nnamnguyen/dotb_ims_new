<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints\Sql;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see OrderByValidator
 *
 */
class OrderBy extends Constraint
{
    const ERROR_ILLEGAL_FORMAT = 1;

    protected static $errorNames = array(
        self::ERROR_ILLEGAL_FORMAT => 'ERROR_ILLEGAL_FORMAT',
    );

    public $message = 'Order by violation: %msg%';
}
