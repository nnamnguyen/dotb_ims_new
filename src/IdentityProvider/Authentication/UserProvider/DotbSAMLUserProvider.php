<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\IdentityProvider\Authentication\UserProvider\SAMLUserProvider;

class DotbSAMLUserProvider extends SAMLUserProvider
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($nameIdentifier)
    {
        return new User($nameIdentifier);
    }
}
