<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints\Sql;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see OrderDirectionValidator
 *
 */
class OrderDirection extends Constraint
{
    const ERROR_ILLEGAL_FORMAT = 1;

    protected static $errorNames = array(
        self::ERROR_ILLEGAL_FORMAT => 'ERROR_ILLEGAL_FORMAT',
    );

    public $message = 'Order direction violation: expecting ASC or DESC';
}
