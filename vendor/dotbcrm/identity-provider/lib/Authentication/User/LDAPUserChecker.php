<?php


namespace Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\IdentityProvider\Authentication\UserProvider\LocalUserProvider;
use Dotbcrm\IdentityProvider\Authentication\User as LocalUser;
use Dotbcrm\IdentityProvider\Authentication\Provider\Providers;

use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * This class performs post authentication checking for LDAP user.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\User
 */
class LDAPUserChecker extends UserChecker
{
    /**
     * @var LocalUserProvider
     */
    protected $localUserProvider;

    /**
     * LDAP provider configuration.
     * @var array
     */
    protected $config;

    public function __construct(LocalUserProvider $localUserProvider, array $config)
    {
        $this->localUserProvider = $localUserProvider;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $user)
    {
        $value = $user->getAttribute('identityValue');
        try {
            $localUser = $this->getLocalUser($value);
        } catch (UsernameNotFoundException $e) {
            if (empty($this->config['auto_create_users'])) {
                throw $e;
            }
            $localUser = $this->localUserProvider->createUser(
                $value,
                Providers::LDAP,
                $user->getAttribute('attributes')
            );
        }
        $user->setLocalUser($localUser);

        parent::checkPostAuth($user);
    }

    /**
     * @param string $value
     * @return LocalUser
     * @throws \Throwable
     */
    private function getLocalUser(string $value): LocalUser
    {
        try {
            $localUser = $this->localUserProvider->loadUserByFieldAndProvider($value, Providers::LDAP);
        } catch (UsernameNotFoundException $e) {
            $localUser = $this->localUserProvider->loadUserByFieldAndProvider($value, Providers::LOCAL);
            $this->localUserProvider->linkUser(
                $localUser->getAttribute('id'),
                Providers::LDAP,
                $value
            );
        }
        return $localUser;
    }
}
