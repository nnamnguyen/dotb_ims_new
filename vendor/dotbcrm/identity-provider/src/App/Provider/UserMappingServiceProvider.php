<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Dotbcrm\IdentityProvider\Authentication\UserMapping\SAMLUserMapping;
use Dotbcrm\IdentityProvider\Authentication\UserMapping\LDAPUserMapping;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class UserMappingServiceProvider
 * @package Dotbcrm\IdentityProvider\App\Provider
 */
class UserMappingServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['SAMLUserMapping'] = $app->protect(function () use ($app) {
            $mapping = (isset($app['config']['saml']['user_mapping'])) ? $app['config']['saml']['user_mapping'] : [];
            return new SAMLUserMapping($mapping);
        });
        $app['LDAPUserMapping'] = $app->protect(function () use ($app) {
            $mapping = (isset($app['config']['ldap']['user_mapping'])) ? $app['config']['ldap']['user_mapping'] : [];
            return new LDAPUserMapping($mapping);
        });
    }
}
