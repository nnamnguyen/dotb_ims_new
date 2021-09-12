<?php


namespace Dotbcrm\IdentityProvider\Saml2\Builder;

use Dotbcrm\IdentityProvider\Saml2\AuthPostBinding;
use Dotbcrm\IdentityProvider\Saml2\Request\LogoutPostRequest;
use Dotbcrm\IdentityProvider\Saml2\Request\AuthnRequest;
use Dotbcrm\IdentityProvider\CSPRNG\Generator as IdGenerator;

/**
 * Provides methods to build suitable request.
 *
 * Class RequestBuilder
 * @package Dotbcrm\IdentityProvider\Saml2\Builder
 */
class RequestBuilder
{
    /** @var  \OneLogin_Saml2_Auth*/
    private $auth;

    /**
     * RequestBuilder constructor.
     * @param \OneLogin_Saml2_Auth $auth
     */
    public function __construct(\OneLogin_Saml2_Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Creates SAML logout request object.
     *
     * @param string $requestData
     * @param array $parameters
     * @return \OneLogin_Saml2_LogoutRequest | LogoutPostRequest
     */
    public function buildLogoutRequest($requestData, array $parameters = [])
    {
        $sessionIndex = $nameId = null;
        if (isset($parameters['sessionIndex'])) {
            $sessionIndex = $parameters['sessionIndex'];
        }
        if (isset($parameters['nameId'])) {
            $nameId = $parameters['nameId'];
        }
        if ($this->auth instanceof AuthPostBinding) {
            return new LogoutPostRequest($this->auth->getSettings(), $requestData, $nameId, $sessionIndex);
        }

        return new \OneLogin_Saml2_LogoutRequest($this->auth->getSettings(), $requestData, $nameId, $sessionIndex);
    }

    /**
     * Creates SAML request object.
     *
     * @param bool|false $forceAuthn
     * @param bool|false $isPassive
     * @param bool|true $setNameIdPolicy
     * @return AuthnRequest
     */
    public function buildLoginRequest($forceAuthn = false, $isPassive = false, $setNameIdPolicy = true)
    {
        return new AuthnRequest(
            $this->auth->getSettings(),
            new IdGenerator(),
            $forceAuthn,
            $isPassive,
            $setNameIdPolicy
        );
    }
}
