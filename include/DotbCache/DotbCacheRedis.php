<?php


use Dotbcrm\Dotbcrm\Cache\Backend\Redis;

/**
 * Redis DotbCache backend, using the PHP Redis C library at http://github.com/nicolasff/phpredis
 *
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\Redis instead
 */
class DotbCacheRedis extends DotbCachePsr
{
    public function __construct()
    {
        parent::__construct(Redis::class, 920, 'external_cache_disabled_redis');
    }
}
