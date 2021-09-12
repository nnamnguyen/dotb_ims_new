<?php


namespace Dotbcrm\Dotbcrm\Security\InputValidation\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 *
 *
 *
 */
class ViolationException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var ConstraintViolationListInterface
     */
    protected $violations;

    /**
     * Ctor
     * @param string $message
     * @param ConstraintViolationListInterface $violations
     */
    public function __construct($message, ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;
        parent::__construct($message);
    }

    /**
     * Get violation object
     * @return ConstraintViolationListInterface
     */
    public function getViolations()
    {
        return $this->violations;
    }
}
