<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\LoadUserOnSessionListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\RehashPasswordListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\UpdateUserLastLoginListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\PostLoginAuthListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\UserPasswordListener;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Subscriber\DotbOnAuthLockoutSubscriber;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbLocalUserProvider;

use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AuthProviderManagerBuilder extends AuthProviderBasicManagerBuilder
{
    /**
     * @return EventDispatcherInterface
     */
    protected function getAuthenticationEventDispatcher()
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new LoadUserOnSessionListener(), 'execute']
        );
        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new RehashPasswordListener(), 'execute']
        );
        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new UserPasswordListener(), 'execute']
        );
        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new UpdateUserLastLoginListener(), 'execute']
        );
        $dispatcher->addListener(
            AuthenticationEvents::AUTHENTICATION_SUCCESS,
            [new PostLoginAuthListener(), 'execute']
        );

        $dispatcher->addSubscriber(new DotbOnAuthLockoutSubscriber(new Lockout(), new DotbLocalUserProvider()));
        return $dispatcher;
    }
}
