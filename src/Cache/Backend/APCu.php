<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache\Backend;

use Dotbcrm\Dotbcrm\Cache\Exception;
use Symfony\Component\Cache\Simple\ApcuCache;

/**
 * APCu implementation of the cache backend
 *
 * @link http://pecl.php.net/package/APCu
 */
final class APCu extends ApcuCache
{
    /**
     * @throws Exception
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();

        if (PHP_SAPI === 'cli' && !ini_get('apc.enable_cli')) {
            throw new Exception('The APCu extension is disabled for CLI');
        }
    }
}
