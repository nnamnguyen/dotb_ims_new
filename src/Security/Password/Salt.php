<?php


namespace Dotbcrm\Dotbcrm\Security\Password;

use Dotbcrm\Dotbcrm\Security\Crypto\CSPRNG;
use Dotbcrm\Dotbcrm\Security\Password\Exception\RuntimeException;

/**
 *
 * Password salt generator
 *
 * This class makes use of the CSPRNG to generate base64 character based
 * salt values. It has the ability to perform per character substitution
 * against the base64 character set to compensate for different encoding
 * schemes.
 *
 */
class Salt
{
    const BASE64_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';

    /**
     * Crypto Secure PRNG
     * @var CSPRNG
     */
    protected $csprng;

    /**
     * Substitution characters
     * @var string
     */
    protected $substitution;

    /**
     * Ctor
     * @param CSPRNG $csprng
     */
    public function __construct(CSPRNG $csprng = null)
    {
        $this->csprng = $csprng ?: CSPRNG::getInstance();
    }

    /**
     * Generate salt value for given size
     * @param integer $size Byte size
     * @return string
     * @throws RuntimeException
     */
    public function generate($size)
    {
        $salt = $this->csprng->generate($size, true);

        if (!$salt) {
            throw RuntimeException("Error generating salt");
        }

        return $this->substitution ? $this->substitute($salt) : $salt;
    }

    /**
     * Set substitution characters
     * @param string $chars
     */
    public function setSubstitution($chars)
    {
        $this->substitution = $chars;
    }

    /**
     * Perform a character by character substitution based on the the
     * configured substitution string against the base64 char set.
     *
     * @param string $salt
     * @return string
     */
    protected function substitute($salt)
    {
        return strtr($salt, self::BASE64_CHARS, $this->substitution);
    }
}
