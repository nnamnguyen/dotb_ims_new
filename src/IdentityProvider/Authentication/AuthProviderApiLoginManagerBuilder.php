<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\LoadUserOnSessionListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;

class AuthProviderApiLoginManagerBuilder extends AuthProviderManagerBuilder
{
    /**
     * @return EventDispatcherInterface
     */
    protected function getAuthenticationEventDispatcher(): EventDispatcherInterface
    {
        $dispatcher = new EventDispatcher();

        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new LoadUserOnSessionListener(), 'execute']
        );

        return $dispatcher;
    }
}
