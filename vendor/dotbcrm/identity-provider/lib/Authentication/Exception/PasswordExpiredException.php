<?php


namespace Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Thrown when system or user-created password is anyhow expired.
 */
class PasswordExpiredException extends AuthenticationException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'Password expired';
    }
}
