<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

use Dotbcrm\IdentityProvider\Authentication\UserMapping\LDAPUserMapping;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Provider\IdPAuthenticationProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Provider\OIDCAuthenticationProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\Mapping\DotbOidcUserMapping;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\DotbOIDCUserChecker;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbOIDCUserProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\SessionProxy;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\DotbSAMLUserChecker;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\Mapping\DotbSAMLUserMapping;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbSAMLUserProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\LocalUserChecker;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\LdapUserChecker;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbLocalUserProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbLdapUserProvider;
use Dotbcrm\Dotbcrm\IdentityProvider\Ldap\Ldap;

use Dotbcrm\IdentityProvider\Encoder\EncoderBuilder;
use Dotbcrm\IdentityProvider\Authentication\Provider\SAMLAuthenticationProvider;
use Dotbcrm\IdentityProvider\Authentication\Provider\LdapAuthenticationProvider;
use Dotbcrm\IdentityProvider\Authentication\Provider\MixedAuthenticationProvider;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\OAuth2\Client\Provider\IdmProvider;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class AuthProviderBasicManagerBuilder
{
    const PROVIDER_KEY_LOCAL = 'DotbLocalProvider';
    const PROVIDER_KEY_LDAP = 'DotbLdapProvider';
    const PROVIDER_KEY_MIXED = 'DotbMixedProvider';
    const PROVIDER_KEY_IDP = 'DotbIdPProvider';
    /**
     * Encoders config
     * @var array|null
     */
    protected $encoderConfig;

    /**
     * ldap config
     * @var array|null
     */
    protected $ldapConfig;

    /**
     * saml config
     * @var array|null
     */
    protected $samlConfig;

    /**
     * @var array
     */
    protected $idmModeConfig;

    /**
     * __construct
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->encoderConfig = $config->get('passwordHash', []);
        if (!empty($this->encoderConfig)) {
            $this->encoderConfig = ['passwordHash' => $this->encoderConfig];
        }
        $this->ldapConfig = $config->getLdapConfig();
        $this->samlConfig = $config->getSAMLConfig();
        $this->idmModeConfig = $config->getIDMModeConfig();
    }

    /**
     * build all available providers
     *
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return AuthenticationProviderManager
     */
    public function buildAuthProviders(EventDispatcherInterface $eventDispatcher = null)
    {
        $providers = array_filter([
                                      $this->getLocalAuthProvider(),
                                      $this->getLdapAuthProvider(),
                                      $this->getSamlAuthIDP(),
                                      $this->getOidcAuthProvider(),
                                      $this->getIdpAuthProvider(),
                                  ]);
        $providers[] = new MixedAuthenticationProvider($providers, static::PROVIDER_KEY_MIXED);
        $manager = new AuthenticationProviderManager($providers);

        if (!$eventDispatcher) {
            $eventDispatcher = $this->getAuthenticationEventDispatcher();
        }
        if ($eventDispatcher) {
            $manager->setEventDispatcher($eventDispatcher);
        }
        return $manager;
    }

    /**
     * return local provider
     * @return DaoAuthenticationProvider
     */
    protected function getLocalAuthProvider()
    {
        $encoderFactory = new EncoderFactory([
            User::class => (new EncoderBuilder())->buildEncoder($this->encoderConfig),
        ]);

        return new DaoAuthenticationProvider(
            new DotbLocalUserProvider(),
            new LocalUserChecker(new Lockout()),
            self::PROVIDER_KEY_LOCAL,
            $encoderFactory
        );
    }

    /**
     * retun ldap provider
     * @return null|LdapAuthenticationProvider
     */
    protected function getLdapAuthProvider()
    {
        if (empty($this->ldapConfig)) {
            return null;
        }

        $userChecker =new LdapUserChecker(
            new Lockout(),
            new DotbLocalUserProvider(),
            $this->ldapConfig
        );

        $adapter = new Adapter($this->ldapConfig['adapter_config']);
        if (!empty($this->ldapConfig['adapter_connection_protocol_version'])) {
            $adapter->getConnection()
                ->setOption('PROTOCOL_VERSION', $this->ldapConfig['adapter_connection_protocol_version']);
        }

        $ldap = new Ldap($adapter);

        $userProvider = new DotbLdapUserProvider(
            $ldap,
            $this->ldapConfig['baseDn'],
            !empty($this->ldapConfig['searchDn']) ? $this->ldapConfig['searchDn'] : null,
            !empty($this->ldapConfig['searchPassword']) ? $this->ldapConfig['searchPassword'] : null,
            User::getDefaultRoles(),
            $this->ldapConfig['uidKey'],
            $this->ldapConfig['filter']
        );

        return new LdapAuthenticationProvider(
            $userProvider,
            $userChecker,
            self::PROVIDER_KEY_LDAP,
            $ldap,
            new LDAPUserMapping([]),
            $this->ldapConfig['dnString'],
            true,
            $this->ldapConfig
        );
    }

    /**
     * return saml auth
     * @return SAMLAuthenticationProvider|null
     */
    protected function getSamlAuthIDP()
    {
        if (empty($this->samlConfig)) {
            return null;
        }

        return new SAMLAuthenticationProvider(
            $this->samlConfig,
            new DotbSAMLUserProvider(),
            new DotbSAMLUserChecker(new DotbLocalUserProvider()),
            new SessionProxy(),
            new DotbSAMLUserMapping($this->samlConfig)
        );
    }

    /**
     * Gets OIDC Authentication provider
     * @return null|OIDCAuthenticationProvider
     */
    protected function getOidcAuthProvider()
    {
        if (empty($this->idmModeConfig)) {
            return null;
        }

        $dotbLocalUserProvider = new DotbLocalUserProvider();

        return new OIDCAuthenticationProvider(
            new IdmProvider($this->idmModeConfig),
            new DotbOIDCUserProvider($dotbLocalUserProvider),
            new DotbOIDCUserChecker($dotbLocalUserProvider),
            new DotbOidcUserMapping()
        );
    }

    /**
     * Gets IdP Authentication provider
     * @return null|IdPAuthenticationProvider
     */
    protected function getIdpAuthProvider()
    {
        if (empty($this->idmModeConfig)) {
            return null;
        }

        $dotbLocalUserProvider = new DotbLocalUserProvider();

        return new IdPAuthenticationProvider(
            new IdmProvider($this->idmModeConfig),
            new DotbOIDCUserProvider($dotbLocalUserProvider),
            new DotbOIDCUserChecker($dotbLocalUserProvider),
            new DotbOidcUserMapping(),
            static::PROVIDER_KEY_IDP
        );
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function getAuthenticationEventDispatcher()
    {
    }
}
