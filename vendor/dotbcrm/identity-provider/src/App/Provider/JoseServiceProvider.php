<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\Authentication\JoseService;

class JoseServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $app['JoseService'] = function ($app) {
            return new JoseService();
        };
    }
}
