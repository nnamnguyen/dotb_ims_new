<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Authentication\AuthProviderManagerBuilder;

class AuthProviderManagerProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['authManager'] = function ($app) {
            /** @var Application $app */
            $authProviderManager = (new AuthProviderManagerBuilder())->buildAuthProviderManager($app);
            $authProviderManager->setEventDispatcher($app->getEventDispatcher());
            return $authProviderManager;
        };
    }
}
