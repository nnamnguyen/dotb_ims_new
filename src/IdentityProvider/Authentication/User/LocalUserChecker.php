<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception\ExternalAuthUserException;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Checks User local authentication regarding Dotb-specific business logic.
 * Does not include logic for common checks that encompass Local, Ldap, SAML; but only specific to the Local auth.
 *
 * Class LocalUserChecker
 * @package Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User
 */
class LocalUserChecker extends DotbUserChecker
{
    /**
     * @inheritdoc
     *
     * @throws ExternalAuthUserException
     */
    public function checkPreAuth(UserInterface $user)
    {
        parent::checkPreAuth($user);

        // There is a checkbox in User's profile - External (LDAP, SAML) auth only.
        // If it's on, User is not allowed to use local Dotb authentication, but only an external one.
        if (!empty($user->getDotbUser()->external_auth_only)) {
            throw new ExternalAuthUserException(
                'External auth only user is not allowed to login using Dotb credentials.'
            );
        }
    }
}
