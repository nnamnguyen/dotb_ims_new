<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueInterface;
use Dotbcrm\Dotbcrm\Security\Validator\ConstraintReturnValueTrait;

/**
 *
 * @see FileValidator
 *
 */
class File extends Constraint implements ConstraintReturnValueInterface
{
    use ConstraintReturnValueTrait;

    const ERROR_NULL_BYTES = 1;
    const ERROR_FILE_NOT_FOUND = 2;
    const ERROR_OUTSIDE_BASEDIR = 3;
    const ERROR_DIR_TRAVERSAL = 4;

    protected static $errorNames = array(
        self::ERROR_NULL_BYTES => 'ERROR_NULL_BYTES',
        self::ERROR_FILE_NOT_FOUND => 'ERROR_FILE_NOT_FOUND',
        self::ERROR_OUTSIDE_BASEDIR => 'ERROR_OUTSIDE_BASEDIR',
        self::ERROR_DIR_TRAVERSAL => 'ERROR_DIR_TRAVERSAL',
    );

    public $message = 'File name violation: %msg%';
    public $baseDirs = array();

    /**
     * {@inheritdoc}
     */
    public function __construct($options = null)
    {
        if (!isset($options['baseDirs'])) {
            $options['baseDirs'][] = realpath(DOTB_BASE_DIR);

            // add additional base directory when shadow is enabled
            if (defined('SHADOW_INSTANCE_DIR')) {
                $options['baseDirs'][] = SHADOW_INSTANCE_DIR;
            }
        }

        parent::__construct($options);
    }
}
