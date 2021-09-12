<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\TenantConfiguration;

/**
 * Class TenantConfigurationServiceProvider
 * @package Dotbcrm\IdentityProvider\App\Provider
 */
class TenantConfigurationServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['tenantConfiguration'] = function ($app) {
            return new TenantConfiguration($app->getDoctrineService(), $app->getConfigAdapterFactory());
        };
    }
}
