<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\Authentication\RememberMe;

class RememberMeServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function register(Container $app)
    {
        $app['RememberMe'] = function ($app) {
            return new RememberMe\Service($app->getSession());
        };
    }
}
