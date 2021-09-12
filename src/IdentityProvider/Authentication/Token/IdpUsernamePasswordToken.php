<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @internal
 * Token for remote Idp auth for legacy support
 */
class IdpUsernamePasswordToken extends UsernamePasswordToken
{
    /**
     * @var string
     */
    protected $tenant;

    /**
     * Constructor.
     *
     * @param string                   $tenant      Tenant SRN
     * @param string|object            $user        The username (like a nickname, email address, etc.), or a UserInterface instance or an object implementing a __toString method
     * @param string                   $credentials This usually is the password of the user
     * @param string                   $providerKey The provider key
     * @param RoleInterface[]|string[] $roles       An array of roles
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($tenant, $user, $credentials, $providerKey, array $roles = array())
    {
        if (empty($tenant)) {
            throw new \InvalidArgumentException('Tenant must not be empty.');
        }
        parent::__construct($user, $credentials, $providerKey, $roles);
        $this->tenant = $tenant;
    }

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }
}
