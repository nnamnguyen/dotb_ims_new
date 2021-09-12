<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;

/**
 * TODO delete this when strtolower+md5 encrypt will be deleted
 */
class RehashPasswordListener
{
    /**
     * rehash encrypted user's password on success auth
     * @param AuthenticationEvent $event
     */
    public function execute(AuthenticationEvent $event)
    {
        $token = $event->getAuthenticationToken();
        if ($token->hasAttribute('isPasswordEncrypted') && !$token->getAttribute('isPasswordEncrypted')) {
            $token->getUser()->getDotbUser()->rehashPassword($token->getAttribute('rawPassword'));
        }
    }
}
