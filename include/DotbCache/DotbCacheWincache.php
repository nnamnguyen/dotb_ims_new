<?php


use Dotbcrm\Dotbcrm\Cache\Backend\WinCache;

/**
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\WinCache instead
 */
class DotbCacheWincache extends DotbCachePsr
{
    public function __construct()
    {
        parent::__construct(WinCache::class, 930, 'external_cache_disabled_wincache');
    }
}
