<?php


use Dotbcrm\Dotbcrm\Cache\Backend\Memcached;

/**
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\Memcached instead
 */
class DotbCacheMemcached extends DotbCachePsr
{
    public function __construct()
    {
        parent::__construct(Memcached::class, 900, 'external_cache_disabled_memcached');
    }
}
