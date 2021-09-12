<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class UpdateUserLastLoginListener
{
    /**
     * set user in globals and session
     * @param AuthenticationEvent $event
     */
    public function execute(AuthenticationEvent $event)
    {
        $event->getAuthenticationToken()->getUser()->getDotbUser()->updateLastLogin();
    }
}
