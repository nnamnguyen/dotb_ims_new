<?php


use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\UsernamePasswordTokenFactory;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\AuthProviderBasicManagerBuilder;
use Dotbcrm\Dotbcrm\IdentityProvider\OAuth2StateRegistry;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\OAuth2\Client\Provider\IdmProvider;
use Dotbcrm\Dotbcrm\Util\Uuid;
use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

/**
 * Class OAuth2Authenticate
 */

class OAuth2Authenticate extends BaseAuthenticate implements ExternalLoginInterface
{
    /**
     * {@inheritdoc}
     * @throws \RuntimeException
     */
    public function getLoginUrl($returnQueryVars = [])
    {
        $config = new Config(\DotbConfig::getInstance());
        $idmModeConfig = $config->getIDMModeConfig();
        if (empty($idmModeConfig['stsUrl'])) {
            throw new \RuntimeException('IDM-mode config and URL were not found.');
        }

        $request = InputValidation::getService();
        $platform = $request->getValidInputGet('platform', null, 'base');
        $state = $platform . '_' . $this->createState();

        return $this->getIdmProvider($idmModeConfig)->getAuthorizationUrl(
            [
                'scope' => $idmModeConfig['requestedOAuthScopes'],
                'state' => $state,
                'tenant_hint' => $idmModeConfig['tid'],
            ]
        );
    }

    /**
     * Create oauth2 state
     * @return string
     */
    protected function createState() : string
    {
        $state = Uuid::uuid4();
        $this->getStateRegistry()->registerState($state);
        return $state;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogoutUrl()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function loginAuthenticate($username, $password, $fallback = false, array $params = [])
    {
        $config = new Config(\DotbConfig::getInstance());
        $token = (new UsernamePasswordTokenFactory($username, $password, ['tenant' => $this->getTenant($config)]))
            ->createIdPAuthenticationToken();
        $manager = $this->getAuthProviderBasicBuilder($config)
            ->buildAuthProviders();
        $resultToken = $manager->authenticate($token);
        if ($resultToken->isAuthenticated()) {
            return [
                'user_id' => $resultToken->getUser()->getDotbUser()->id,
                'scope' => null,
            ];
        }
        return false;
    }

    /**
     * @param Config $config
     *
     * @return string
     */
    protected function getTenant(Config $config)
    {
        $idmModeConfig = $config->get('idm_mode', []);
        return !empty($idmModeConfig['tid']) ? $idmModeConfig['tid'] : '';
    }

    /**
     * @param Config $config
     *
     * @return AuthProviderBasicManagerBuilder
     */
    protected function getAuthProviderBasicBuilder(Config $config)
    {
        return new AuthProviderBasicManagerBuilder($config);
    }

    /**
     * Gets IdmProvider instance
     * @param array $idmModeConfig
     * @return IdmProvider
     */
    protected function getIdmProvider(array $idmModeConfig): IdmProvider
    {
        return new IdmProvider($idmModeConfig);
    }

    /**
     * @return OAuth2StateRegistry
     */
    protected function getStateRegistry() : OAuth2StateRegistry
    {
        return new OAuth2StateRegistry();
    }
}
