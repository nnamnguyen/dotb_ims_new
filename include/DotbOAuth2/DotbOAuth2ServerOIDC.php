<?php


use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\AuthProviderOIDCManagerBuilder;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\AuthProviderApiLoginManagerBuilder;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\AuthProviderBasicManagerBuilder;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC\IntrospectToken;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC\JWTBearerToken;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC\RefreshToken;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Token\OIDC\CodeToken;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Dotbcrm\IdentityProvider\Srn;
use Dotbcrm\Dotbcrm\Util\Uuid;
use Dotbcrm\Dotbcrm\Logger\Factory as LoggerFactory;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Dotb OAuth2.0 server that connects Dotb and OpenID Connect server (e.g. STS authentication).
 * @api
 */
class DotbOAuth2ServerOIDC extends DotbOAuth2Server implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    const PORTAL_PLATFORM = 'portal';

    /**
     * @var string
     */
    protected $platform;

    /**
     * DotbOAuth2ServerOIDC constructor.
     *
     * @param IOAuth2Storage $storage
     * @param array $config
     */
    public function __construct(IOAuth2Storage $storage, array $config)
    {
        parent::__construct($storage, $config);
        $this->setLogger(LoggerFactory::getLogger('authentication'));
    }

    /**
     * Sets the platform
     *
     * @param string $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }

    /**
     * @inheritdoc
     * @throws OAuth2ServerException
     * @throws \InvalidArgumentException
     */
    public function grantAccessToken(array $inputData = null, array $authHeaders = null) : array
    {
        $oidcGrantType = [self::GRANT_TYPE_REFRESH_TOKEN, self::GRANT_TYPE_AUTH_CODE];
        $sourceToken = null;

        if (empty($inputData['grant_type'])) {
            throw new OAuth2ServerException(
                self::HTTP_BAD_REQUEST,
                self::ERROR_INVALID_REQUEST,
                'Invalid grant_type parameter or parameter missing'
            );
        }

        if (!in_array($inputData['grant_type'], $oidcGrantType, true)) {
            return parent::grantAccessToken($inputData, $authHeaders);
        }

        switch ($inputData['grant_type']) {
            case self::GRANT_TYPE_REFRESH_TOKEN:
                if (!$this->storage instanceof IOAuth2RefreshTokens) {
                    throw new OAuth2ServerException(self::HTTP_BAD_REQUEST, self::ERROR_UNSUPPORTED_GRANT_TYPE);
                }

                if (empty($inputData['refresh_token'])) {
                    throw new OAuth2ServerException(
                        self::HTTP_BAD_REQUEST,
                        self::ERROR_INVALID_REQUEST,
                        'No "refresh_token" parameter found'
                    );
                }

                if (Uuid::isValid($inputData['refresh_token'])) {
                    return parent::grantAccessToken($inputData, $authHeaders);
                }
                $sourceToken = new RefreshToken($inputData['refresh_token']);
                break;
            case self::GRANT_TYPE_AUTH_CODE:
                if (empty($inputData['code']) || empty($inputData['scope'])) {
                    throw new OAuth2ServerException(
                        self::HTTP_BAD_REQUEST,
                        self::ERROR_INVALID_REQUEST,
                        'Missing parameters'
                    );
                }

                if (Uuid::isValid($inputData['code'])) {
                    return parent::grantAccessToken($inputData, $authHeaders);
                }

                $sourceToken = new CodeToken($inputData['code'], $inputData['scope']);
                break;
        }

        if (!$sourceToken) {
            throw new OAuth2ServerException(self::HTTP_BAD_REQUEST, self::ERROR_INVALID_REQUEST);
        }

        try {
            $idpConfig = new Config(\DotbConfig::getInstance());
            $authManager = $this->getAuthProviderBasicBuilder($idpConfig)->buildAuthProviders();
            /** @var TokenInterface  $resultToken */
            $resultToken = $authManager->authenticate($sourceToken);
            return [
                'access_token' => $resultToken->getAttribute('token'),
                'expires_in' => $resultToken->getAttribute('expires_in'),
                'token_type' => $resultToken->getAttribute('token_type'),
                'scope' => $resultToken->getAttribute('scope'),
                'refresh_token' => $resultToken->getAttribute('refresh_token'),
                'download_token' => $resultToken->getAttribute('token'),
                'refresh_expires_in' => time() + $this->getVariable(self::CONFIG_REFRESH_LIFETIME),
            ];
        } catch (AuthenticationException $e) {
            throw new OAuth2ServerException(self::HTTP_BAD_REQUEST, self::ERROR_INVALID_REQUEST, $e->getMessage());
        }
    }

    /**
     * Verifies openID connect token delegating it to OIDC server.
     * Loads PHP session bound to the token.
     *
     * @param string $token OIDC Access Token
     * @param string|null $scope
     *
     * @throws OAuth2AuthenticateException
     * @return array
     */
    public function verifyAccessToken($token, $scope = null)
    {
        /*
         * Parent token verification should be applied if access token is a uuid generated by DotBCRM
         * For example portal platform should not pass through new oauth2
         */
        if (Uuid::isValid($token)) {
            return parent::verifyAccessToken($token, $scope);
        }

        $userToken = null;
        try {
            $config = new Config(\DotbConfig::getInstance());
            $authManager = $this->getAuthProviderBuilder($config)->buildAuthProviders();
            $introspectToken = new IntrospectToken(
                $token,
                $config->getIDMModeConfig()['tid'],
                $config->getIDMModeConfig()['crmOAuthScope']
            );
            $introspectToken->setAttribute('platform', $this->platform);
            /** @var IntrospectToken $userToken */
            $userToken = $authManager->authenticate($introspectToken);
        } catch (AuthenticationException $e) {
            $this->logger->debug('IDM mode introspect exception: ' . $e->getMessage());
            throw new OAuth2AuthenticateException(
                self::HTTP_UNAUTHORIZED,
                $this->getVariable(self::CONFIG_TOKEN_TYPE),
                $this->getVariable(self::CONFIG_WWW_REALM),
                self::ERROR_INVALID_GRANT,
                'The access token provided has expired.',
                $scope
            );
        }

        if (!$userToken->isAuthenticated()) {
            return [];
        }

        return [
            'client_id' => $userToken->getAttribute('client_id'),
            'user_id' => $userToken->getUser()->getDotbUser()->id,
            'expires' => $userToken->getAttribute('exp'),
        ];
    }

    /**
     * @inheritdoc
     */
    protected function createAccessToken($client_id, $user_id, $scope = null)
    {
        $dotbConfig = \DotbConfig::getInstance();
        $idpConfig = new Config($dotbConfig);
        $idmModeConfig = $idpConfig->getIDMModeConfig();

        $tenantSrn = Srn\Converter::fromString($idmModeConfig['tid']);
        $srnManagerConfig = [
            'partition' => $tenantSrn->getPartition(),
            'region' => $tenantSrn->getRegion(),
        ];
        $srnManager = new Srn\Manager($srnManagerConfig);
        $userSrn = $srnManager->createUserSrn($tenantSrn->getTenantId(), $user_id);

        try {
            $authManager = $this->getAuthProviderApiLoginBuilder($idpConfig)->buildAuthProviders();
            $jwtBearerToken = new JWTBearerToken(Srn\Converter::toString($userSrn), $idmModeConfig['tid']);
            $accessToken = $authManager->authenticate($jwtBearerToken);

            $token = array(
                'access_token' => $accessToken->getAttribute('token'),
                'expires_in' => $accessToken->getAttribute('expires_in'),
                'token_type' => $accessToken->getAttribute('token_type'),
                'scope' => $accessToken->getAttribute('scope'),
            );

            if ($this->storage instanceof IOAuth2RefreshTokens) {
                $token['refresh_token'] = $this->genAccessToken();
                $this->storage->setRefreshToken(
                    $token['refresh_token'],
                    $client_id,
                    $user_id,
                    time() + $this->getVariable(self::CONFIG_REFRESH_LIFETIME),
                    $token['scope']
                );
                $this->storage->refreshToken->download_token = $token['access_token'];
                $this->storage->refreshToken->save();
                if ($this->oldRefreshToken) {
                    $this->storage->unsetRefreshToken($this->oldRefreshToken);
                    unset($this->oldRefreshToken);
                }
            }

            return $token;
        } catch (AuthenticationException $e) {
            throw new \DotbApiExceptionNeedLogin($e->getMessage());
        }
    }

    /**
     * @param Config $config
     * @return AuthProviderApiLoginManagerBuilder
     */
    protected function getAuthProviderApiLoginBuilder(Config $config): AuthProviderApiLoginManagerBuilder
    {
        return new AuthProviderApiLoginManagerBuilder($config);
    }

    /**
     * @param Config $config
     * @return AuthProviderOIDCManagerBuilder
     */
    protected function getAuthProviderBuilder(Config $config)
    {
        return new AuthProviderOIDCManagerBuilder($config);
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
     * Set old refresh token
     * This is required for unit tests
     * @param $refreshToken
     * @return DotbOAuth2ServerOIDC
     */
    public function setOldRefreshToken($refreshToken)
    {
        $this->oldRefreshToken = $refreshToken;
        return $this;
    }
}
