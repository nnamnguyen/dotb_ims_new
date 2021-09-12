<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Dotbcrm\IdentityProvider\App\Authentication\AuthProviderManagerBuilder;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Token to store SAML auth result
 */
class ResultToken extends AbstractToken
{
    /**
     * @var string
     */
    protected $credentials = null;

    /**
     * @param string $credentials
     * @param array $attributes
     */
    public function __construct($credentials, $attributes)
    {
        $this->credentials = $credentials;
        $this->setAttributes($attributes);
    }

    /**
     * @return string
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * return provider key
     * @return string
     */
    public function getProviderKey()
    {
        return AuthProviderManagerBuilder::PROVIDER_KEY_SAML;
    }
}
