<?php


namespace Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SAMLRequestException extends AuthenticationException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'Authentication SAML request is not valid';
    }
}
