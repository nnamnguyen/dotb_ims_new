<?php


namespace Dotbcrm\IdentityProvider\App;

use Doctrine\DBAL\Connection;

use Monolog\Logger;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\PsrLogMessageProcessor;

use Psr\Log\LoggerInterface;

use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\CsrfServiceProvider;

use Dotbcrm\Apis\Iam\App\V1alpha\IAMAppClient;
use Dotbcrm\Apis\Iam\User\V1alpha\UserAPIClient;
use Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter\ConfigAdapterFactory;
use Dotbcrm\IdentityProvider\App\Provider\ConfigAdapterFactoryServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\EncoderFactoryProvider;
use Dotbcrm\IdentityProvider\App\Provider\GrpcServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\RepositoriesProvider;
use Dotbcrm\IdentityProvider\App\Provider\JoseServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\ListenerProvider;
use Dotbcrm\IdentityProvider\App\Provider\OAuth2ServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\AuthProviderManagerProvider;
use Dotbcrm\IdentityProvider\App\Provider\ConfigServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\SrnManagerServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\UserMappingServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\RememberMeServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\TenantConfigurationServiceProvider;
use Dotbcrm\IdentityProvider\App\Provider\ConsentRequestProvider;
use Dotbcrm\IdentityProvider\App\Provider\UsernamePasswordTokenFactoryProvider;
use Dotbcrm\IdentityProvider\App\Provider\ErrorPageHandlerProvider;
use Dotbcrm\IdentityProvider\App\Repository\ConsentRepository;
use Dotbcrm\IdentityProvider\App\Repository\OneTimeTokenRepository;
use Dotbcrm\IdentityProvider\App\Repository\TenantRepository;
use Dotbcrm\IdentityProvider\App\Repository\UserProvidersRepository;
use Dotbcrm\IdentityProvider\Authentication\Token\UsernamePasswordTokenFactory;
use Dotbcrm\IdentityProvider\Authentication\UserMapping\MappingInterface;


use Dotbcrm\IdentityProvider\Srn\Manager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Dotbcrm\IdentityProvider\App\Instrumentation;

class Application extends SilexApplication
{
    const ENV_PROD = 'prod';
    const ENV_DEV = 'dev';
    const ENV_TESTS = 'tests';
    const ENV_DEFAULT = self::ENV_PROD;

    /**
     * Prometheus metrics endpoint
     * @var string
     */
    const METRICS_ENDPOINT = '/metrics';

    /**
     * @var string
     */
    protected $env;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * Allowed environments
     * @var array
     */
    protected $allowedEnv = [
        self::ENV_TESTS,
        self::ENV_DEV,
        self::ENV_PROD,
    ];

    /**
     * @inheritdoc
     */
    public function __construct(array $values = ['env' => self::ENV_DEFAULT])
    {
        $environment = (string) $values['env'];
        $this->env = in_array($environment, $this->allowedEnv) ? $environment : self::ENV_DEFAULT;

        $this->rootDir = realpath(__DIR__ . '/../../');

        parent::__construct();

        $this->register(new ConfigServiceProvider(isset($values['configOverride']) ? $values['configOverride'] : []));

        $this->register(new MonologServiceProvider(), $this['config']['monolog']);
        $this->extend('monolog', function (Logger $monolog, Application $app) {
            return $monolog->pushProcessor(new UidProcessor())
                ->pushProcessor(new WebProcessor())
                ->pushProcessor(new IntrospectionProcessor())
                ->pushProcessor(new PsrLogMessageProcessor())
                ->pushHandler(
                    new ErrorLogHandler(
                        ErrorLogHandler::OPERATING_SYSTEM,
                        $app['config']['monolog']['monolog.level'],
                        $app['config']['monolog']['monolog.bubble']
                    )
                );
        });

        $this->register(new AssetServiceProvider(), [
            'assets.named_packages' => [
                'css' => ['base_path' => 'css'],
                'js' => ['base_path' => 'js'],
                'images' => ['base_path' => 'img'],
            ],
        ]);

        $this->register(new TwigServiceProvider(), [
            'twig.options' => array_replace([
                'cache' => $this->rootDir . '/var/cache/twig',
                'strict_variables' => true,
            ], $this['config']['twig']['twig.options'] ?? []),
            'twig.path' => __DIR__ . '/Resources/views',
        ]);
        $this->getTwigService()->addExtension(new Twig\Extension($this));

        $this->register(new ValidatorServiceProvider());

        $this->register(new DoctrineServiceProvider(), $this['config']['db']);
        $this->register(new RepositoriesProvider());

        // Should be before TenantConfigurationServiceProvider
        $this->register(new ConfigAdapterFactoryServiceProvider());

        // Should be before:
        //  AuthProviderManagerProvider, UserMappingServiceProvider, UsernamePasswordTokenFactoryProvider
        // Add after DoctrineServiceProvider
        $this->register(new TenantConfigurationServiceProvider());

        $this->register(new SessionServiceProvider(), [
            'session.test' => $environment === self::ENV_TESTS,
            'session.storage.options' => $this['config']['session.storage.options'],
        ]);

        $this['session.storage.handler'] = function () {
            return new PdoSessionHandler(
                $this['db']->getWrappedConnection(),
                [
                    'db_table' => 'sessions',
                    'db_id_col' => 'session_id',
                    'db_data_col' => 'session_value',
                    'db_lifetime_col' => 'session_lifetime',
                    'db_time_col' => 'session_time',
                    'lock_mode' => PdoSessionHandler::LOCK_ADVISORY,
                ]
            );
        };

        $this->register(new AuthProviderManagerProvider());
        $this->register(new UserMappingServiceProvider());
        $this->register(new JoseServiceProvider());
        $this->register(new OAuth2ServiceProvider());
        $this->register(new ConsentRequestProvider());
        $this->register(new UsernamePasswordTokenFactoryProvider());
        $this->register(new SrnManagerServiceProvider());
        $this->register(new CsrfServiceProvider());
        $this->register(new ErrorPageHandlerProvider());
        $this->register(new RememberMeServiceProvider());
        $this->register(new ListenerProvider());
        $this->register(new EncoderFactoryProvider());
        $this->register(new GrpcServiceProvider());

        // bind routes
        $this->mount('', new ControllerProvider());

        // instrumentation
        $prometheusMetrics = new Instrumentation\PrometheusMetrics(self::METRICS_ENDPOINT);
        $prometheusMetrics->initialize($this);
        $this->get(self::METRICS_ENDPOINT, $prometheusMetrics->render());
    }

    /**
     * @return string
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @return string
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * SERVICE ACCESSORS
     */

    /**
     * @return \Twig_Environment
     */
    public function getTwigService()
    {
        return $this['twig'];
    }

    /**
     * @return RecursiveValidator
     */
    public function getValidatorService()
    {
        return $this['validator'];
    }

    /**
     * @return Connection
     */
    public function getDoctrineService()
    {
        return $this['db'];
    }

    /**
     * @return AuthenticationProviderManager
     */
    public function getAuthManagerService()
    {
        return $this['authManager'];
    }

    /**
     * @return UrlGenerator
     */
    public function getUrlGeneratorService()
    {
        return $this['url_generator'];
    }

    /**
     * @return LoggerInterface;
     */
    public function getLogger()
    {
        return $this['logger'];
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this['session'];
    }

    /**
     * @param string $type Type of the mapping service (ldap, saml).
     *
     * @return MappingInterface
     */
    public function getUserMappingService($type)
    {
        $mappingServiceName = strtoupper($type) . 'UserMapping';
        if (empty($this[$mappingServiceName])) {
            throw new \InvalidArgumentException("Requested mapping service $mappingServiceName is missing");
        }
        return $this[$mappingServiceName]();
    }

    /**
     * @param string $username
     * @param string $password
     * @return UsernamePasswordTokenFactory
     */
    public function getUsernamePasswordTokenFactory($username, $password)
    {
        return $this['usernamePasswordTokenFactory']($username, $password);
    }

    /**
     * @return ConsentRepository
     */
    public function getConsentRepository(): ConsentRepository
    {
        return $this['consentRepository'];
    }

    /**
     * @return TenantRepository
     */
    public function getTenantRepository(): TenantRepository
    {
        return $this['tenantRepository'];
    }

    public function getOneTimeTokenRepository(): OneTimeTokenRepository
    {
        return $this['oneTimeTokenRepository'];
    }

    /**
     * @return UserProvidersRepository
     */
    public function getUserProvidersRepository(): UserProvidersRepository
    {
        return $this['userProvidersRepository'];
    }

    /**
     * @return TenantConfiguration
     */
    public function getTenantConfiguration()
    {
        return $this['tenantConfiguration'];
    }

    /**
     * @return ConfigAdapterFactory
     */
    public function getConfigAdapterFactory()
    {
        return $this['configAdapterFactory'];
    }

    /**
     * @param string $region
     * @return Manager
     */
    public function getSrnManager(string $region): Manager
    {
        return $this['SrnManager']($region);
    }

    /**
     * @return \Dotbcrm\IdentityProvider\App\Authentication\OAuth2Service
     */
    public function getOAuth2Service()
    {
        return $this['oAuth2Service'];
    }

    /**
     * @return \Dotbcrm\IdentityProvider\App\Authentication\JoseService
     */
    public function getJoseService()
    {
        return $this['JoseService'];
    }

    /**
     * @return \Dotbcrm\IdentityProvider\App\Authentication\ConsentRequest\ConsentRestService
     */
    public function getConsentRestService()
    {
        return $this['consentRestService'];
    }

    /**
     * @return \Symfony\Component\Security\Csrf\CsrfTokenManager
     */
    public function getCsrfTokenManager()
    {
        return $this['csrf.token_manager'];
    }

    /**
     * @return \Dotbcrm\IdentityProvider\Authentication\RememberMe\Service
     */
    public function getRememberMeService()
    {
        return $this['RememberMe'];
    }

    /**
     * @return EventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this['dispatcher'];
    }

    /**
     * Get Application config.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this['config'] ?? [];
    }

    /**
     * @return EncoderFactory
     */
    public function getEncoderFactory(): EncoderFactory
    {
        return $this['encoderFactory'];
    }

    /**
     * Get ServiceDiscovery.
     *
     * @return ServiceDiscovery
     */
    public function getServiceDiscovery(): ServiceDiscovery
    {
        return $this['grpc.discovery'];
    }

    /**
     * @return UserAPIClient
     */
    public function getGrpcUserApi(): UserAPIClient
    {
        return $this['grpc.userapi'];
    }

    /**
     * @return IAMAppClient
     */
    public function getGrpcAppApi(): IAMAppClient
    {
        return $this['grpc.appapi'];
    }
}
