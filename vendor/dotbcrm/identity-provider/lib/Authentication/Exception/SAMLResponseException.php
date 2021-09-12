<?php


namespace Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SAMLResponseException extends AuthenticationException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'Authentication SAML response is not valid';
    }
}
