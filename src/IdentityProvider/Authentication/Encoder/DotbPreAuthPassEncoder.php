<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Encoder;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class DotbPreAuthPassEncoder implements PasswordEncoderInterface
{
    /**
     * encode form login raw password before check
     * @param string $raw
     * @param string $salt
     * @param bool $isPasswordEncrypted
     * @return string
     */
    public function encodePassword($raw, $salt, $isPasswordEncrypted = false)
    {
        if (!$isPasswordEncrypted) {
            $raw = strtolower(md5($raw));
        }
        return $raw;
    }

    /**
     * Will be implemented in Phase 2
     * @param string $encoded
     * @param string $raw
     * @param string $salt
     * @return bool
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return false;
    }
}
