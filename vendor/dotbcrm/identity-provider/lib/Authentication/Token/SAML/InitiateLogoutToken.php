<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class InitiateLogoutToken extends AbstractToken implements ActionTokenInterface
{

    /**
     * @inheritdoc
     */
    public function getCredentials()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAction()
    {
        return ActionTokenInterface::LOGOUT_ACTION;
    }
}
