<?php


namespace Dotbcrm\Dotbcrm\Security\InputValidation\Sanitizer;

/**
 *
 * Sanitizer interface
 *
 * Input sanitization which is applied on every superglobal value before
 * constraint specific sanitizing and validation occurs.
 *
 * Note that sanitizing is a bad habit. It is better to teach your users how to
 * properly format input data by having full whitelist validation reject badly
 * crafted values.
 *
 */
interface SanitizerInterface
{
    /**
     * @param mixed $value Value to be sanitized
     * @return mixed Sanitized value
     */
    public function sanitize($value);
}
