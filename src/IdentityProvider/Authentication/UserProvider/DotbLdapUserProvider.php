<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\IdentityProvider\Authentication\UserProvider\LdapUserProvider;

use Symfony\Component\Ldap\Entry;
use Symfony\Component\Security\Core\User\User as StandardUser;

class DotbLdapUserProvider extends LdapUserProvider
{
    /**
     * Loads a user from an LDAP entry. Saves LDAP entry as User attribute for further using.
     *
     * @param string $username
     * @param Entry $entry
     *
     * @return User
     */
    protected function loadUser($username, Entry $entry)
    {
        /* @var StandardUser $standardUser */
        $standardUser = parent::loadUser($username, $entry);

        return new User(
            $standardUser->getUsername(),
            $standardUser->getPassword(),
            ['entry' => $entry]
        );
    }
}
