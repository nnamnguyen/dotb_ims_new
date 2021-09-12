<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class InitiateToken
 *
 * Token which used to initiate SAML authentication process.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\Token
 */
class InitiateToken extends AbstractToken implements ActionTokenInterface
{
    /**
     * @inheritDoc
     */
    public function getCredentials()
    {
        // there is no any credentials when we initiating SAML authentication.
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAction()
    {
        return ActionTokenInterface::LOGIN_ACTION;
    }
}
