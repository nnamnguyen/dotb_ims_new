<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\App\Authentication\OAuth2Service;
use Dotbcrm\IdentityProvider\STS\EndpointInterface;
use Dotbcrm\IdentityProvider\STS\EndpointService;
use Dotbcrm\IdentityProvider\League\OAuth2\Client\Provider\HttpBasicAuth\GenericProvider as OAuth2Provider;

class OAuth2ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['oAuth2Service'] = function ($app) {
            $oAuth2Config = (isset($app['config']['sts'])) ? $app['config']['sts'] : [];
            $stsEndpoint = new EndpointService($oAuth2Config);
            $oAuth2Provider = new OAuth2Provider(
                [
                    'clientId' => $oAuth2Config['clientId'],
                    'clientSecret' => $oAuth2Config['clientSecret'],
                    'accessTokenFile' => $oAuth2Config['accessTokenFile'],
                    'accessTokenRefreshUrl' => $oAuth2Config['accessTokenRefreshUrl'],
                    'urlAuthorize' => $stsEndpoint->getOAuth2Endpoint(EndpointInterface::AUTH_ENDPOINT),
                    'urlAccessToken' => $stsEndpoint->getOAuth2Endpoint(EndpointInterface::TOKEN_ENDPOINT),
                    'urlIntrospectToken' => $stsEndpoint->getOAuth2Endpoint(EndpointInterface::INTROSPECT_ENDPOINT),
                    'urlResourceOwnerDetails' => $stsEndpoint->getWellKnownConfigurationEndpoint(),
                    'logger' => $app->getLogger(),
                ]
            );
            return new OAuth2Service($stsEndpoint, $oAuth2Provider);
        };
    }
}
