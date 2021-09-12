<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class CodeToken
 * Provides token that can perform auth_code OIDC operation
 */
class CodeToken extends AbstractToken
{
    /**
     * @var string
     */
    protected $credentials;

    /**
     * OAuth scope
     * @var string
     */
    protected $scope;

    /**
     * OIDCToken constructor.
     * @param string $credentials OAuth2 token.
     * @param string $scope Tenant SRN
     * @param array $roles
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $credentials, string $scope, array $roles = [])
    {
        parent::__construct($roles);

        $this->scope = $scope;
        $this->credentials = $credentials;
    }

    /**
     * @inheritdoc
     */
    public function getCredentials(): string
    {
        return $this->credentials;
    }

    /**
     * Get scope.
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }
}
