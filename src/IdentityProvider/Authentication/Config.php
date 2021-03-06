<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

use Dotbcrm\IdentityProvider\STS\EndpointInterface;
use Dotbcrm\IdentityProvider\STS\EndpointService;

/**
 * Configuration glue for IdM
 */
class Config
{
    /**
     * @var \DotbConfig
     */
    protected $dotbConfig;

    /**
     * @var \Administration
     */
    protected $ldapSettings;

    /**
     * @var \Configurator
     */
    protected $configurator;

    /**
     * @param \DotbConfig $dotbConfig
     */
    public function __construct(\DotbConfig $dotbConfig)
    {
        $this->dotbConfig = $dotbConfig;
    }

    /**
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->dotbConfig->get($key, $default);
    }

    /**
     * Builds proper configuration suitable for SAMLAuthenticationProvider
     *
     * @return array
     */
    public function getSAMLConfig()
    {
        $defaultConfig = $this->getSAMLDefaultConfig();
        return array_replace_recursive($defaultConfig, $this->get('SAML', [])); //update with values from config
    }

    /**
     * Gets IDM mode configuration
     * @return array
     */
    public function getIDMModeConfig()
    {
        if (!$this->isIDMModeEnabled()) {
            return [];
        }

        $config = $this->get('idm_mode');

        $stsUrl = rtrim($config['stsUrl'], '/ ');
        $ipdUrl = rtrim($config['idpUrl'], '/ ');
        $stsKeySetId = isset($config['stsKeySetId']) ? $config['stsKeySetId'] : null;
        $urlKeys = $stsKeySetId ? $stsUrl . '/keys/' . $stsKeySetId : null;

        $endpointService = new EndpointService(['host' => $stsUrl]);

        $idmModeConfig = [
            'tid' => !empty($config['tid']) ? $config['tid'] : '',
            'clientId' => $config['clientId'],
            'clientSecret' => $config['clientSecret'],
            'stsUrl' => $stsUrl,
            'idpUrl' => $ipdUrl,
            'redirectUri' => rtrim($this->get('site_url'), '/') . '/?module=Users&action=OAuth2CodeExchange',
            'urlAuthorize' => $endpointService->getOAuth2Endpoint(EndpointInterface::AUTH_ENDPOINT),
            'urlAccessToken' => $endpointService->getOAuth2Endpoint(EndpointInterface::TOKEN_ENDPOINT),
            'urlResourceOwnerDetails' => $endpointService->getOAuth2Endpoint(EndpointInterface::INTROSPECT_ENDPOINT),
            'urlUserInfo' => $endpointService->getUserInfoEndpoint(),
            'http_client' => !empty($config['http_client']) ? $config['http_client'] : [],
            'cloudConsoleUrl' => !empty($config['cloudConsoleUrl']) ? $config['cloudConsoleUrl'] : '',
            'cloudConsoleRoutes' => !empty($config['cloudConsoleRoutes']) ? $config['cloudConsoleRoutes'] : [],
            'caching' => array_replace_recursive($this->getIDMModeDefaultCachingConfig(), $config['caching'] ?? []),
            'crmOAuthScope' => $config['crmOAuthScope'] ?? '',
            'requestedOAuthScopes' => $config['requestedOAuthScopes'] ?? [],
        ];

        if ($stsKeySetId) {
            $idmModeConfig['keySetId'] = $stsKeySetId;
            $idmModeConfig['urlKeys'] = $urlKeys;
        }

        return $idmModeConfig;
    }

    /**
     * Builds URL for Cloud Console navigation.
     *
     * If you provide key of the pre-configured Cloud Console URI it takes it's value from the config.
     *
     * Additionally you can pass a list of params to specify concrete action and/or resource,
     * e.g. ['users', 'user-id', 'permissions'] will give you 'users/user-id'/permissions' URI.
     *
     * @param string $pathKey
     * @param array $parts
     * @return string
     */
    public function buildCloudConsoleUrl($pathKey, $parts = [])
    {
        $config = $this->getIDMModeConfig();
        $serverUrl = rtrim($config['cloudConsoleUrl'], '/');
        $additional = [];

        if (array_key_exists($pathKey, $config['cloudConsoleRoutes'])) {
            $additional[] = trim($config['cloudConsoleRoutes'][$pathKey], '/');
        }

        $additional = array_merge($additional, array_map('urlencode', $parts));

        return join('/', array_merge([$serverUrl], $additional));
    }

    /**
     * Checks IDM mode is enabled
     * @return bool
     */
    public function isIDMModeEnabled() : bool
    {
        return (bool)$this->get('idm_mode.enabled', false);
    }

    /**
     * Enable or disable IDM mode
     *
     * @param false|array $config
     */
    public function setIDMMode($config) : void
    {
        $configurator = $this->getConfigurator();
        if ($config) {
            $configurator->config['idm_mode'] = $config;
        } else {
            $configurator->config['idm_mode']['enabled'] = false;
        }
        $configurator->handleOverride();
        $configurator->clearCache();
        $this->dotbConfig->clearCache('idm_mode');
        $this->dotbConfig->clearCache('idm_mode.enabled');
        $this->refreshMetadata();
    }

    /**
     * Refresh config metadata
     */
    protected function refreshMetadata() : void
    {
        \MetaDataManager::refreshSectionCache(\MetaDataManager::MM_CONFIG);
    }


    /**
     * return disabled modules in IDM mode
     * @return array
     */
    public function getIDMModeDisabledModules()
    {
        return ['Users', 'Employees'];
    }

    /**
     * return IDM mode disabled fields
     * @return array
     */
    public function getIDMModeDisabledFields()
    {
        return array_filter($this->getUserVardef(), function ($def) {
            return !empty($def['idm_mode_disabled']);
        });
    }

    /**
     * @return \Configurator
     */
    protected function getConfigurator() : \Configurator
    {
        if (is_null($this->configurator)) {
            $this->configurator = new \Configurator();
        }
        return $this->configurator;
    }

    /**
     *
     * Used to retrieve the field defs for a Users module
     *
     * @return array
     */
    protected function getUserVardef()
    {
        return \VardefManager::getFieldDefs('Users');
    }

    /**
     * Get default config for php-saml library
     *
     * @return array
     */
    protected function getSAMLDefaultConfig()
    {
        $isSPPrivateKeyCertSet = (bool)$this->get('SAML_request_signing_pkey')
            && (bool)$this->get('SAML_request_signing_x509');
        $siteUrl = rtrim($this->get('site_url'), '/');
        $acsUrl = sprintf('%s/index.php?module=Users&action=Authenticate', $siteUrl);
        $sloUrl = sprintf('%s/index.php?module=Users&action=Logout', $siteUrl);
        $idpSsoUrl = htmlspecialchars_decode($this->get('SAML_loginurl'), ENT_QUOTES);
        $idpSloUrl = htmlspecialchars_decode($this->get('SAML_SLO'), ENT_QUOTES);
        return [
            'strict' => false,
            'debug' => false,
            'sp' => [
                'entityId' => htmlspecialchars_decode($this->get('SAML_issuer', 'php-saml'), ENT_QUOTES) ?: 'php-saml',
                'assertionConsumerService' => [
                    'url' => $acsUrl,
                    'binding' => \OneLogin_Saml2_Constants::BINDING_HTTP_POST,
                ],
                'singleLogoutService' => [
                    'url' => $sloUrl,
                    'binding' => \OneLogin_Saml2_Constants::BINDING_HTTP_REDIRECT,
                ],
                'NameIDFormat' =>\OneLogin_Saml2_Constants::NAMEID_EMAIL_ADDRESS,
                'x509cert' => $this->get('SAML_request_signing_x509', ''),
                'privateKey' => $this->get('SAML_request_signing_pkey', ''),
                'provisionUser' => $this->get('SAML_provisionUser', true),
            ],

            'idp' => [
                'entityId' => htmlspecialchars_decode($this->get('SAML_idp_entityId', $idpSsoUrl), ENT_QUOTES),
                'singleSignOnService' => [
                    'url' => $idpSsoUrl,
                    'binding' => \OneLogin_Saml2_Constants::BINDING_HTTP_REDIRECT,
                ],
                'singleLogoutService' => [
                    'url' => $idpSloUrl,
                    'binding' => \OneLogin_Saml2_Constants::BINDING_HTTP_REDIRECT,
                ],
                'x509cert' => $this->get('SAML_X509Cert'),
            ],

            'security' => [
                'authnRequestsSigned' => $isSPPrivateKeyCertSet && $this->get('SAML_sign_authn', false),
                'logoutRequestSigned' => $isSPPrivateKeyCertSet && $this->get('SAML_sign_logout_request', false),
                'logoutResponseSigned' => $isSPPrivateKeyCertSet && $this->get('SAML_sign_logout_response', false),
                'signatureAlgorithm' => $this->get('SAML_request_signing_method', \XMLSecurityKey::RSA_SHA256),
                'validateRequestId' => $this->get('saml.validate_request_id', false),
            ],
        ];
    }

    /**
     * returns mapped mango ldap config
     * @return array
     */
    public function getLdapConfig()
    {
        if (!$this->isLdapEnabled()) {
            return [];
        }

        // make sure host is in symfony/ldap format
        $host = $this->getLdapSetting('ldap_hostname', '127.0.0.1');
        $encryption = 'none';
        if (strpos($host, 'ldaps://') === 0) {
            $host = substr($host, strlen('ldaps://'));
            $encryption = 'ssl';
        }

        $ldap = [
            'adapter_config' => [
                'host' => $host,
                'port' => $this->getLdapSetting('ldap_port', 389),
                'options' => [
                    'network_timeout' => 60,
                    'timelimit' => 60,
                ],
                'encryption' => $encryption,
            ],
            'adapter_connection_protocol_version' => 3,
            'baseDn' => $this->getLdapSetting('ldap_base_dn', ''),
            'uidKey' => $this->getLdapSetting('ldap_login_attr', ''),
            'filter' => $this->buildLdapSearchFilter(),
            'dnString' => null,
            'entryAttribute' => $this->getLdapSetting('ldap_bind_attr'),
            'autoCreateUser' => $this->getLdapSetting('ldap_auto_create_users', false),
        ];
        if (!empty($this->getLdapSetting('ldap_authentication'))) {
            $ldap['searchDn'] = $this->getLdapSetting('ldap_admin_user');
            $ldap['searchPassword'] = $this->getLdapSetting('ldap_admin_password');
        }

        if (!empty($this->getLdapSetting('ldap_group'))) {
            $ldap['groupMembership'] = true;
            $ldap['groupDn'] = sprintf(
                '%s,%s',
                $this->getLdapSetting('ldap_group_name'),
                $this->getLdapSetting('ldap_group_dn')
            );
            $ldap['groupAttribute'] = $this->getLdapSetting('ldap_group_attr');
            $ldap['userUniqueAttribute'] = $this->getLdapSetting('ldap_group_user_attr');
            $ldap['includeUserDN'] = (bool) $this->getLdapSetting('ldap_group_attr_req_dn', false);
        }

        return array_merge($this->getLdapDefaultConfig(), $ldap);
    }

    /**
     * Creates a valid LDAP filter string based on configuration.
     *
     * @return string
     */
    protected function buildLdapSearchFilter()
    {
        $defaultFilter = '({uid_key}={username})';
        $loginFilter = $this->getLdapSetting('ldap_login_filter', '');
        if ($loginFilter) {
            $loginFilter = '(' . trim($loginFilter, " ()\t\n\r\0\x0B") . ')';
            return '(&' . $defaultFilter . $loginFilter . ')';
        }
        return $defaultFilter;
    }

    /**
     * Is LDAP enabled?
     * @return bool
     */
    protected function isLdapEnabled()
    {
        $system = \Administration::getSettings('system');
        return !empty($system->settings['system_ldap_enabled']);
    }

    /**
     * return settings value from mango ldap settings
     * @param $key
     * @param null $default
     * @return mixed
     */
    protected function getLdapSetting($key, $default = null)
    {
        if (!$this->ldapSettings) {
            $this->ldapSettings = \Administration::getSettings('ldap');
        }
        if (isset($this->ldapSettings->settings[$key])) {
            return trim(htmlspecialchars_decode($this->ldapSettings->settings[$key])) ?: $default;
        }

        return $default;
    }

    /**
     * return default config for ldap
     * @return array
     */
    protected function getLdapDefaultConfig()
    {
        return [
            'user' => [
                'mapping' => [
                    'givenName' => 'first_name',
                    'sn' => 'last_name',
                    'mail' => 'email1',
                    'telephoneNumber' => 'phone_work',
                    'facsimileTelephoneNumber' => 'phone_fax',
                    'mobile' => 'phone_mobile',
                    'street' => 'address_street',
                    'l' => 'address_city',
                    'st' => 'address_state',
                    'postalCode' => 'address_postalcode',
                    'c' => 'address_country',
                ],
            ],
        ];
    }

    /**
     * Get default IdM mode caching settings
     *
     * @return array
     */
    protected function getIDMModeDefaultCachingConfig() : array
    {
        return [
            'ttl' => [
                'introspectToken' => 10, // 10 seconds for introspecting user token
                'userInfo' => 10, // 10 seconds for requesting user info
                'keySet' => 7 * 24 * 60 * 60, // 7 days for requesting keySet for Mango client
            ],
        ];
    }
}
