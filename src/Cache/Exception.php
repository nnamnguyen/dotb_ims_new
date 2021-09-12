<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache;

use Psr\SimpleCache\CacheException;

/**
 * Cache exception
 */
class Exception extends \Exception implements CacheException
{
}
