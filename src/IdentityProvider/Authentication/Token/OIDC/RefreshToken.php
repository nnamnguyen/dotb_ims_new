<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class RefreshToken
 * Provides token that can perform refresh OIDC operation
 */
class RefreshToken extends AbstractToken
{
    /**
     * @var string
     */
    protected $credentials;

    /**
     * @param string $credentials OAuth2 token
     * @param array $roles
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $credentials, array $roles = [])
    {
        parent::__construct($roles);

        $this->credentials = $credentials;
    }

    /**
     * @inheritdoc
     */
    public function getCredentials() : string
    {
        return $this->credentials;
    }
}
