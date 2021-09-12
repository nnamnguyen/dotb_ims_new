<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbLocalUserProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Lockout;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Ldap\Entry;

/**
 * creates dotb user after success auth if it's required
 */
class LdapUserChecker extends DotbUserChecker
{
    /**
     * @var DotbLocalUserProvider
     */
    protected $localProvider;

    /**
     * @var array
     */
    protected $ldapConfig;

    /**
     * @param Lockout $lockout
     * @param DotbLocalUserProvider $localProvider
     * @param array $ldapConfig
     */
    public function __construct(Lockout $lockout, DotbLocalUserProvider $localProvider, array $ldapConfig = [])
    {
        parent::__construct($lockout);

        $this->localProvider = $localProvider;
        $this->ldapConfig = $ldapConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function checkPostAuth(UserInterface $user)
    {
        $this->loadDotbUser($user);
        parent::checkPostAuth($user);
    }

    /**
     * load dotb user
     * @param User $user
     */
    protected function loadDotbUser(User $user)
    {
        try {
            $dotbUser = $this->localProvider->loadUserByUsername($user->getUsername())->getDotbUser();
        } catch (UsernameNotFoundException $e) {
            if (!empty($this->ldapConfig['autoCreateUser'])) {
                $dotbUser = $this->localProvider->createUser(
                    $user->getUsername(),
                    $this->getMappedValues($user->getAttribute('entry'))
                );
            } else {
                throw $e;
            }
        }
        $user->setDotbUser($dotbUser);
    }

    /**
     * return mango user mapped array from entity attributes
     * @param Entry $entry
     * @return array
     */
    protected function getMappedValues(Entry $entry)
    {
        $result = [];
        if (!empty($this->ldapConfig['user']['mapping']) && is_array($this->ldapConfig['user']['mapping'])) {
            foreach ($this->ldapConfig['user']['mapping'] as $attr => $property) {
                if ($entry->hasAttribute($attr)) {
                    $result[$property] = $entry->getAttribute($attr)[0];
                }
            }
        }

        $fixedAttributes = [
            'employee_status' => User::USER_EMPLOYEE_STATUS_ACTIVE,
            'status' => User::USER_STATUS_ACTIVE,
            'is_admin' => 0,
            'external_auth_only' => 1,
        ];

        $result = array_merge($result, $fixedAttributes);

        return $result;
    }
}
