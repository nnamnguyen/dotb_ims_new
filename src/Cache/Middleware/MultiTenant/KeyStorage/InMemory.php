<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant\KeyStorage;

use Rhumsaa\Uuid\Uuid;
use Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant\KeyStorage;

/**
 * In-memory implementation of the key storage
 */
final class InMemory implements KeyStorage
{
    /**
     * @var Uuid|null
     */
    private $key;

    /**
     * {@inheritDoc}
     */
    public function getKey() : ?Uuid
    {
        return $this->key;
    }

    /**
     * {@inheritDoc}
     */
    public function updateKey(Uuid $key) : void
    {
        $this->key = $key;
    }
}
