<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DotbOIDCUserProvider implements UserProviderInterface
{
    /**
     * @var DotbLocalUserProvider
     */
    protected $dotbLocalUserProvider;
    /**
     * DotbOIDCUserProvider constructor.
     * @param UserProviderInterface $dotbLocalUserProvider
     */
    public function __construct(UserProviderInterface $dotbLocalUserProvider)
    {
        $this->dotbLocalUserProvider = $dotbLocalUserProvider;
    }

    /**
     * @param string $username
     * @return User
     */
    public function loadUserByUsername($username)
    {
        return new User($username);
    }

    /**
     * @param string $srn
     * @return User
     */
    public function loadUserBySrn($srn)
    {
        $user = new User(null, null);
        $user->setSrn($srn);
        return $user;
    }

    /**
     * Get user by field value.
     *
     * @param string $value
     * @param string $field
     * @return User
     */
    public function loadUserByField($value, $field)
    {
        return $this->dotbLocalUserProvider->loadUserByField($value, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $class === User::class;
    }
}
