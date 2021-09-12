<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Token which is used to consume SAML Response from IdP.
 */
class IdpLogoutToken extends AbstractToken implements ActionTokenInterface
{
    /**
     * SAML Request as plain base64 encoded string.
     * In SAML it is user's credentials for authentication.
     *
     * @var string
     */
    protected $samlRequest;

    /**
     * @inheritDoc
     */
    public function __construct($samlRequest, array $roles = [])
    {
        $this->samlRequest = $samlRequest;
        parent::__construct($roles);
    }

    /**
     * SAMLRequest is a user's credentials for authentication.
     */
    public function getCredentials()
    {
        return $this->samlRequest;
    }

    /**
     * @inheritdoc
     */
    public function getAction()
    {
        return ActionTokenInterface::LOGOUT_ACTION;
    }
}
