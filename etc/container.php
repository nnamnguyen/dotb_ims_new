<?php


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheException;
use Psr\SimpleCache\CacheInterface;
use Dotbcrm\Dotbcrm\Audit\EventRepository;
use Dotbcrm\Dotbcrm\Audit\Formatter as AuditFormatter;
use Dotbcrm\Dotbcrm\Audit\Formatter\CompositeFormatter;
use Dotbcrm\Dotbcrm\Cache\Backend\APCu as APCuCache;
use Dotbcrm\Dotbcrm\Cache\Backend\BackwardCompatible as BackwardCompatibleCache;
use Dotbcrm\Dotbcrm\Cache\Backend\InMemory as InMemoryCache;
use Dotbcrm\Dotbcrm\Cache\Backend\Memcached as MemcachedCache;
use Dotbcrm\Dotbcrm\Cache\Backend\Redis as RedisCache;
use Dotbcrm\Dotbcrm\Cache\Backend\WinCache;
use Dotbcrm\Dotbcrm\Cache\Middleware\DefaultTTL;
use Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant as MultiTenantCache;
use Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant\KeyStorage\Configuration as ConfigurationKeyStorage;
use Dotbcrm\Dotbcrm\Cache\Middleware\Replicate;
use Dotbcrm\Dotbcrm\DataPrivacy\Erasure\Repository;
use Dotbcrm\Dotbcrm\Dbal\Logging\DebugLogger;
use Dotbcrm\Dotbcrm\Dbal\Logging\Formatter as DbalFormatter;
use Dotbcrm\Dotbcrm\Dbal\Logging\SlowQueryLogger;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Command\Rebuild;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Command\StateAwareRebuild;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Console\StatusCommand;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Job\RebuildJob;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Builder\StateAwareBuilder;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Composite;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Logger;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\StateAwareListener;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State\Storage\AdminSettingsStorage;
use Dotbcrm\Dotbcrm\DependencyInjection\Exception\ServiceUnavailable;
use Dotbcrm\Dotbcrm\Logger\Factory as LoggerFactory;
use Dotbcrm\Dotbcrm\Security\Context;
use Dotbcrm\Dotbcrm\Security\Subject\Formatter as SubjectFormatter;
use Dotbcrm\Dotbcrm\Security\Subject\Formatter\BeanFormatter;
use Dotbcrm\Dotbcrm\Security\Validator\Validator;
use UltraLite\Container\Container;

return new Container([
    DotbConfig::class => function () {
        return DotbConfig::getInstance();
    },
    Connection::class => function () {
        return DBManagerFactory::getConnection();
    },
    SQLLogger::class => function (ContainerInterface $container) : SQLLogger {
        $config = $container->get(DotbConfig::class);

        $channel = LoggerFactory::getLogger('db');

        $logger = new LoggerChain();
        $logger->addLogger(new DebugLogger($channel));

        if ($config->get('dump_slow_queries')) {
            $logger->addLogger(
                new SlowQueryLogger(
                    $channel,
                    $config->get('slow_query_time_msec', 5000)
                )
            );
        }

        DbalFormatter::wrapLogger($channel);

        return $logger;
    },
    LoggerInterface::class => function () {
        return LoggerFactory::getLogger('default');
    },
    LoggerInterface::class . '-denorm' => function () {
        return LoggerFactory::getLogger('denorm');
    },
    LoggerInterface::class . '-security' => function () {
        return LoggerFactory::getLogger('security');
    },
    State::class => function (ContainerInterface $container) {
        $config = $container->get(DotbConfig::class);

        $state = new State(
            $config,
            new AdminSettingsStorage(),
            $container->get(LoggerInterface::class . '-denorm')
        );
        $config->attach($state);

        return $state;
    },
    Listener::class => function (ContainerInterface $container) {
        $state = $container->get(State::class);
        $builder = new StateAwareBuilder(
            $container->get(Connection::class),
            $state
        );

        $logger = $container->get(LoggerInterface::class . '-denorm');

        $listener = new StateAwareListener($builder, $logger);
        $state->attach($listener);

        return new Composite(
            new Logger($logger),
            $listener
        );
    },
    StateAwareRebuild::class => function (ContainerInterface $container) {
        $logger = $container->get(LoggerInterface::class . '-denorm');

        return new StateAwareRebuild(
            $container->get(State::class),
            new Rebuild(
                $container->get(Connection::class),
                $logger
            ),
            $logger
        );
    },
    StatusCommand::class => function (ContainerInterface $container) {
        return new StatusCommand(
            $container->get(State::class)
        );
    },
    RebuildJob::class => function (ContainerInterface $container) {
        return new RebuildJob(
            $container->get(StateAwareRebuild::class)
        );
    },
    Context::class => function (ContainerInterface $container) {
        return new Context(
            $container->get(LoggerInterface::class . '-security')
        );
    },
    Localization::class => function () {
        return Localization::getObject();
    },
    SubjectFormatter::class => function (ContainerInterface $container) {
        return new BeanFormatter(
            $container->get(Localization::class)
        );
    },
    EventRepository::class => function (ContainerInterface $container) {
        return new EventRepository(
            $container->get(Connection::class),
            $container->get(Context::class)
        );
    },
    Repository::class => function (ContainerInterface $container) {
        return new Repository(
            $container->get(Connection::class)
        );
    },
    AuditFormatter::class => function (ContainerInterface $container) {
        $class = \DotbAutoLoader::customClass(CompositeFormatter::class);
        return new $class(
            new \Dotbcrm\Dotbcrm\Audit\Formatter\Date(),
            new \Dotbcrm\Dotbcrm\Audit\Formatter\Enum(),
            new \Dotbcrm\Dotbcrm\Audit\Formatter\Email(),
            new \Dotbcrm\Dotbcrm\Audit\Formatter\Subject($container->get(SubjectFormatter::class))
        );
    },
    Administration::class => function () : Administration {
        return BeanFactory::newBean('Administration');
    },
    CacheInterface::class => function (ContainerInterface $container) : CacheInterface {
        $config = $container->get(DotbConfig::class);

        if ($config->get('external_cache_disabled')) {
            return new InMemoryCache();
        }

        $backend = $container->get(
            $config->get('cache.backend') ?? BackwardCompatibleCache::class
        );

        $backend = new DefaultTTL($backend, $config->get('cache_expire_timeout') ?: 300);

        if ($config->get('cache.multi_tenant')) {
            $backend = new MultiTenantCache(
                $config->get('unique_key'),
                new ConfigurationKeyStorage($config),
                $backend,
                $container->get(LoggerInterface::class)
            );
        }

        return new Replicate(
            $backend,
            new InMemoryCache()
        );
    },
    BackwardCompatibleCache::class => function () : BackwardCompatibleCache {
        return new BackwardCompatibleCache(DotbCache::electBackend());
    },
    ApcuCache::class => function () : ApcuCache {
        try {
            return new ApcuCache();
        } catch (CacheException $e) {
            throw new ServiceUnavailable($e->getMessage(), 0, $e);
        }
    },
    RedisCache::class => function (ContainerInterface $container) : RedisCache {
        $config = $container->get(DotbConfig::class)->get('external_cache.redis');

        try {
            return new RedisCache($config['host'] ?? null, $config['port'] ?? null);
        } catch (CacheException $e) {
            throw new ServiceUnavailable($e->getMessage(), 0, $e);
        }
    },
    MemcachedCache::class => function (ContainerInterface $container) : MemcachedCache {
        $config = $container->get(DotbConfig::class)->get('external_cache.memcache');

        try {
            return new MemcachedCache($config['host'] ?? null, $config['port'] ?? null);
        } catch (CacheException $e) {
            throw new ServiceUnavailable($e->getMessage(), 0, $e);
        }
    },
    WinCache::class => function () : WinCache {
        try {
            return new WinCache();
        } catch (CacheException $e) {
            throw new ServiceUnavailable($e->getMessage(), 0, $e);
        }
    },
    Validator::class => function () {
        return Validator::getService();
    },
]);
