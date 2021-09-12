<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class ConsumeLogoutToken
 *
 * Token which is used to consume SAML Response from IdP.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\Token
 */
class ConsumeLogoutToken extends AbstractToken implements ActionTokenInterface
{
    /**
     * SAML Response as plain base64 encoded string.
     *
     * @var string
     */
    private $samlResponse;

    /**
     * @inheritDoc
     */
    public function __construct($samlResponse, array $roles = [])
    {
        $this->samlResponse = $samlResponse;
        parent::__construct($roles);
    }

    /**
     * @inheritDoc
     */
    public function getCredentials()
    {
        return $this->samlResponse;
    }

    /**
     * @inheritdoc
     */
    public function getAction()
    {
        return ActionTokenInterface::LOGOUT_ACTION;
    }
}
