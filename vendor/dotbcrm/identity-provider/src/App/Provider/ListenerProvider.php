<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Listener\Success\UpdateUserLastLoginListener;
use Dotbcrm\IdentityProvider\App\Listener\Success\UserPasswordListener;
use Dotbcrm\IdentityProvider\App\Subscriber\OnAuthLockoutSubscriber;
use Dotbcrm\IdentityProvider\App\Authentication\Lockout;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;

class ListenerProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        /** @var Application $app */
        /** @var EventDispatcher $dispatcher */
        $app->extend('dispatcher', function (EventDispatcherInterface $dispatcher, $app) {
            $dispatcher->addListener(
                AuthenticationEvents::AUTHENTICATION_SUCCESS,
                new UpdateUserLastLoginListener($app->getDoctrineService())
            );
            $dispatcher->addListener(
                AuthenticationEvents::AUTHENTICATION_SUCCESS,
                new UserPasswordListener($app)
            );
            $dispatcher->addSubscriber(
                new OnAuthLockoutSubscriber(
                    new Lockout($app),
                    $app->getDoctrineService(),
                    $app->getSession(),
                    $app->getLogger()
                )
            );

            return $dispatcher;
        });
    }
}
