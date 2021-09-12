<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueInterface;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueTrait;

/**
 *
 * @see PhpSerializedValidator
 *
 */
class PhpSerialized extends Constraint implements ConstraintReturnValueInterface
{
    use ConstraintReturnValueTrait;

    const ERROR_OBJECT_NOT_ALLOWED = 1;
    const ERROR_UNSERIALIZE = 2;
    const ERROR_BASE64_DECODE = 3;
    const ERROR_REFERENCE_NOT_ALLOWED = 4;

    protected static $errorNames = array(
        self::ERROR_OBJECT_NOT_ALLOWED => 'ERROR_OBJECT_NOT_ALLOWED',
        self::ERROR_REFERENCE_NOT_ALLOWED => 'ERROR_REFERENCE_NOT_ALLOWED',
        self::ERROR_UNSERIALIZE => 'ERROR_UNSERIALIZE',
        self::ERROR_BASE64_DECODE => 'ERROR_BASE64_DECODE',
    );

    public $message = 'PHP serialized data violation: %msg%';
    public $base64Encoded = false;
    public $htmlEncoded = false;
}
