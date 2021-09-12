<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter\ConfigAdapterFactory;

class ConfigAdapterFactoryServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['configAdapterFactory'] = function ($app) {
            return new ConfigAdapterFactory($app->getUrlGeneratorService());
        };
    }
}
