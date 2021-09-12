<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueInterface;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueTrait;

/**
 *
 * @see JSONValidator
 *
 */
class JSON extends Constraint implements ConstraintReturnValueInterface
{
    use ConstraintReturnValueTrait;

    const ERROR_JSON_DECODE = 1;

    protected static $errorNames = array(
        self::ERROR_JSON_DECODE => 'ERROR_JSON_DECODE',
    );

    public $message = 'JSON decode data violation: %msg%';
    public $htmlDecode = false;
    public $assoc = true;
}
