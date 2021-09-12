<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Dotbcrm\Dotbcrm\Security\InputValidation\Superglobals;
use Symfony\Component\Validator\Constraint;

/**
 *
 * @see InputParametersValidator
 *
 */
class InputParameters extends Constraint
{
    const ERROR_REQUEST = 1;
    const ERROR_GET = 2;
    const ERROR_POST = 3;

    protected static $errorNames = array(
        self::ERROR_REQUEST => 'ERROR_REQUEST',
        self::ERROR_GET => 'ERROR_GET',
        self::ERROR_POST => 'ERROR_POST',
    );

    public $msgGeneric = 'Generic input violation for input parameter [%type%]';
    public $msgNullBytes = 'Null bytes violation for input parameter [%type%]';
    public $inputType = Superglobals::GET;
}
