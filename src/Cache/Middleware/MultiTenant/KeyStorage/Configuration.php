<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant\KeyStorage;

use Configurator;
use InvalidArgumentException;
use Rhumsaa\Uuid\Uuid;
use DotbConfig;
use Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant\KeyStorage;

/**
 * Temporary implementation until we figure how to eliminate the mutual dependency between cache and admin settings
 */
final class Configuration implements KeyStorage
{
    /**
     * @var DotbConfig
     */
    private $config;

    public function __construct(DotbConfig $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function getKey() : ?Uuid
    {
        $key = $this->config->get('cache.encryption_key');

        try {
            return Uuid::fromString($key);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateKey(Uuid $key) : void
    {
        $configurator = new Configurator();
        $configurator->config['cache']['encryption_key'] = $key->toString();
        $configurator->handleOverride();

        $this->config->clearCache();
    }
}
