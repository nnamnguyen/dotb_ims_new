<?php


namespace Dotbcrm\Dotbcrm\Security\InputValidation\Sanitizer;

use Dotbcrm\Dotbcrm\Security\InputValidation\Exception\SanitizerException;

/**
 *
 * Generic input sanitizer
 *
 */
class Sanitizer implements SanitizerInterface
{
    /**
     * Ctor
     * @throws SanitizerException
     */
    public function __construct()
    {
        // Don't deal with magic quotes anymore, it needs to be disabled, period.
        if ($this->hasMagicQuotesEnabled()) {
            throw new SanitizerException('magic_quotes_gpc needs to be disabled');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sanitize($value)
    {
        return $value;
    }

    /**
     * Check if magic quotes are enabled
     * @return boolean
     */
    protected function hasMagicQuotesEnabled()
    {
        return get_magic_quotes_gpc();
    }
}
