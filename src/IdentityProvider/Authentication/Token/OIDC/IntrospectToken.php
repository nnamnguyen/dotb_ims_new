<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class IntrospectToken
 * Provides token that can perform introspection OIDC operation
 */
class IntrospectToken extends AbstractToken
{
    /**
     * @var string
     */
    protected $credentials;

    /**
     * Tenant SRN
     * @var string
     */
    protected $tenant;

    /**
     * CRM OAuth Scope
     * @var string
     */
    protected $crmOAuthScope;

    /**
     * OIDCToken constructor.
     * @param string $credentials OAuth2 token.
     * @param string $tenant Tenant SRN
     * @param string $crmOAuthScope CRM OAuth Scope
     * @param array $roles
     */
    public function __construct($credentials, $tenant, $crmOAuthScope, $roles = array())
    {
        parent::__construct($roles);

        $this->tenant = $tenant;
        $this->crmOAuthScope = $crmOAuthScope;
        $this->credentials = $credentials;
    }

    /**
     * @inheritdoc
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Tenant SRN
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @return string
     */
    public function getCrmOAuthScope()
    {
        return $this->crmOAuthScope;
    }
}
