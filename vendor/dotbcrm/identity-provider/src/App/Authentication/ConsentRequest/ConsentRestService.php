<?php


namespace Dotbcrm\IdentityProvider\App\Authentication\ConsentRequest;

use Dotbcrm\IdentityProvider\App\Authentication\OAuth2Service;

class ConsentRestService implements ConsentTokenServiceInterface
{
    /**
     * list of allowed scope mapping
     */
    protected const SCOPE_MAPPING = [
        'offline' => 'Access your information anytime',
        'profile' => 'View your profile',
        'email' => 'View your email',
        'address' => 'View your address',
        'phone' => 'View your phone',
        'openid' => 'Authenticate using OpenID Connect',
        'https://apis.dotbcrm.com/auth/crm' => 'Access your DotbCRM instance',
        'https://apis.dotbcrm.com/auth/iam' => 'View and manage your Identity & Access Management (IAM) objects',
    ];

    /**
     * @var OAuth2Service
     */
    protected $oAuth2Service;

    /**
     * ConsentRequestParser constructor.
     * @param OAuth2Service $oAuth2Service
     */
    public function __construct(OAuth2Service $oAuth2Service)
    {
        $this->oAuth2Service = $oAuth2Service;
    }

    /**
     * Return consent Pay Load.
     * @param string $identifier
     * @return ConsentToken
     */
    public function getToken($identifier)
    {
        return (new ConsentToken())->fillByConsentRequestData(
            $this->oAuth2Service->getConsentRequestData($identifier)
        );
    }

    /**
     * return scope mapping
     * @return array
     */
    public function getScopeMapping(): array
    {
        return self::SCOPE_MAPPING;
    }
}
