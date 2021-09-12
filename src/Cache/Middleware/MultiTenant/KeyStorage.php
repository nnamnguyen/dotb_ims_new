<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache\Middleware\MultiTenant;

use Rhumsaa\Uuid\Uuid;

/**
 * Multi-tenant cache key storage
 */
interface KeyStorage
{
    /**
     * Returns the currently effective key
     *
     * @return Uuid
     */
    public function getKey() : ?Uuid;

    /**
     * Updates the key
     *
     * @param Uuid $key
     */
    public function updateKey(Uuid $key) : void;
}
