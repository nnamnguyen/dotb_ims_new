<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\Authentication\Token\UsernamePasswordTokenFactory;

/**
 * Class UsernamePasswordTokenFactoryProvider
 * @package Dotbcrm\IdentityProvider\App\Provider
 */
class UsernamePasswordTokenFactoryProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['usernamePasswordTokenFactory'] = $app->protect(function ($username, $password) use ($app) {
            return new UsernamePasswordTokenFactory($app['config'], $username, $password);
        });
    }
}
