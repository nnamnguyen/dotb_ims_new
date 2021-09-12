<?php


use Dotbcrm\Dotbcrm\Cache\Backend\APCu;

/**
 * APCu cache backend
 *
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\APCu instead
 */
class DotbCacheApcu extends DotbCachePsr
{
    public function __construct()
    {
        parent::__construct(APCu::class, 935, 'external_cache_disabled_apcu');
    }
}
