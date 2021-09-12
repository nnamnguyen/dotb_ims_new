<?php


namespace Dotbcrm\Dotbcrm\Util;

use Rhumsaa\Uuid\Uuid as UuidBackend;

/**
 *
 * RFC 4122 Universally unique identifier wrappers (UUID)
 *
 */
class Uuid
{
    /**
     * Generate variant 1 (time-based) UUID
     * @return string
     */
    public static function uuid1()
    {
        return UuidBackend::uuid1()->toString();
    }

    /**
     * Generate variant 4 (random) UUID
     * @return string
     */
    public static function uuid4()
    {
        return UuidBackend::uuid4()->toString();
    }

    /**
     * validate uuid
     * @param string $uuid
     * @return bool
     */
    public static function isValid(string $uuid)
    {
        return UuidBackend::isValid($uuid);
    }
}
