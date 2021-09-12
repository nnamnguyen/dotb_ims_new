<?php

namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\IdentityProvider\Encoder\EncoderBuilder;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class EncoderFactoryProvider
 * @package Dotbcrm\IdentityProvider\App\Provider
 */
class EncoderFactoryProvider implements ServiceProviderInterface
{
    public function register(Container $app): void
    {
        $app['encoderFactory'] = function ($app) {
            $encoderBuilder = new EncoderBuilder();
            return new EncoderFactory([
                User::class => $encoderBuilder->buildEncoder($app['config']),
            ]);
        };
    }
}
