<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Authentication\ConsentRequest\ConsentRestService;

class ConsentRequestProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['consentRestService'] = function ($app) {
            /** @var Application $app */
            return new ConsentRestService($app->getOAuth2Service());
        };
    }
}
