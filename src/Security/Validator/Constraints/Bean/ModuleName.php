<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints\Bean;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see ModuleNameValidator
 *
 */
class ModuleName extends Constraint
{
    const ERROR_UNKNOWN_MODULE = 1;

    protected static $errorNames = array(
        self::ERROR_UNKNOWN_MODULE => 'ERROR_UNKNOWN_MODULE',
    );

    public $message = 'Invalid module %module%';
}
