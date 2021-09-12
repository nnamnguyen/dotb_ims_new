<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\Repository\ConsentRepository;
use Dotbcrm\IdentityProvider\App\Repository\OneTimeTokenRepository;
use Dotbcrm\IdentityProvider\App\Repository\TenantRepository;
use Dotbcrm\IdentityProvider\App\Repository\UserProvidersRepository;

class RepositoriesProvider implements ServiceProviderInterface
{
    public function register(Container $app): void
    {
        $app['consentRepository'] = function ($app) {
            return new ConsentRepository($app['db']);
        };

        $app['tenantRepository'] = function ($app) {
            return new TenantRepository($app['db']);
        };

        $app['oneTimeTokenRepository'] = function ($app) {
            return new OneTimeTokenRepository($app['db']);
        };

        $app['userProvidersRepository'] = function ($app) {
            return new UserProvidersRepository($app['db']);
        };
    }
}
