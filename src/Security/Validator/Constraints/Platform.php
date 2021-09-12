<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 *
 * @see PlatformValidator
 *
 */
class Platform extends Constraint
{
    const ERROR_INVALID_PLATFORM_FORMAT = 0;
    const ERROR_INVALID_PLATFORM = 1;

    /**
     * {@inheritdoc}
     */
    protected static $errorNames = array(
        self::ERROR_INVALID_PLATFORM_FORMAT => 'ERROR_INVALID_PLATFORM_FORMAT',
        self::ERROR_INVALID_PLATFORM => 'ERROR_INVALID_PLATFORM',
    );

    /**
     * Message template
     * @var string
     */
    public $message = 'Platform name violation: %reason% (%platform%)';
}
