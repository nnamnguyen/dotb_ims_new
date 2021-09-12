<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\LoadUserOnSessionListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\OIDCSessionListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\PostLoginAuthListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\RehashPasswordListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\UpdateUserLastLoginListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\UserPasswordListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;

class AuthProviderOIDCManagerBuilder extends AuthProviderManagerBuilder
{
    /**
     * @return EventDispatcherInterface
     */
    protected function getAuthenticationEventDispatcher()
    {
        $dispatcher = new EventDispatcher();

        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new OIDCSessionListener(), 'execute'],
            999
        );

        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new LoadUserOnSessionListener(), 'execute']
        );

        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new UpdateUserLastLoginListener(), 'execute']
        );
        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new PostLoginAuthListener(), 'execute']
        );

        return $dispatcher;
    }
}
