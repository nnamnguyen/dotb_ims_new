<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class AcsToken
 *
 * Token which is used to consume SAML Response from IdP.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\Token
 */
class AcsToken extends AbstractToken implements ActionTokenInterface
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
        return ActionTokenInterface::LOGIN_ACTION;
    }
}
