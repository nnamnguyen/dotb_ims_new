<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token\SAML;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Provides token specific behaviour for action.
 *
 * Interface ActionTokenInterface
 * @package Dotbcrm\IdentityProvider\Authentication\Token\SAML
 */
interface ActionTokenInterface extends TokenInterface
{
    const LOGIN_ACTION = 'login';

    const LOGOUT_ACTION = 'logout';

    /**
     * Token action such as LOGIN_ACTION or LOGOUT_ACTION
     * @return string
     */
    public function getAction();
}
