<?php


namespace Dotbcrm\IdentityProvider\Saml2\Builder;

use Dotbcrm\IdentityProvider\Saml2\AuthPostBinding;
use Dotbcrm\IdentityProvider\Saml2\Response\LogoutPostResponse;

/**
 * Provides methods to build suitable response.
 *
 * Class ResponseBuilder
 * @package Dotbcrm\IdentityProvider\Saml2\Builder
 *
 */
class ResponseBuilder
{
    /** @var  \OneLogin_Saml2_Auth*/
    private $auth;

    /**
     * ResponseBuilder constructor.
     * @param \OneLogin_Saml2_Auth $auth
     */
    public function __construct(\OneLogin_Saml2_Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Creates SAML logout response object.
     *
     * @param $responseData
     * @return \OneLogin_Saml2_LogoutResponse|LogoutPostResponse
     */
    public function buildLogoutResponse($responseData = null)
    {
        if ($this->auth instanceof AuthPostBinding) {
            return new LogoutPostResponse($this->auth->getSettings(), $responseData);
        }

        return new \OneLogin_Saml2_LogoutResponse($this->auth->getSettings(), $responseData);
    }

    /**
     * Creates SAML response object.
     *
     * @param $responseData
     * @return \OneLogin_Saml2_Response
     */
    public function buildLoginResponse($responseData)
    {
        return new \OneLogin_Saml2_Response($this->auth->getSettings(), $responseData);
    }
}
