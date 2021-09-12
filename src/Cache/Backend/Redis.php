<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache\Backend;

use Redis as Client;
use RedisException;
use Dotbcrm\Dotbcrm\Cache\Exception;
use Symfony\Component\Cache\Simple\RedisCache;

/**
 * Redis implementation of the cache backend
 *
 * @link http://pecl.php.net/package/redis
 */
final class Redis extends RedisCache
{
    /**
     * @param string|null $host
     * @param int|null $port
     *
     * @throws Exception
     * @codeCoverageIgnore
     */
    public function __construct(?string $host, ?int $port = null)
    {
        if (!extension_loaded('redis')) {
            throw new Exception('Redis extension is not loaded');
        }

        $client = new Client();

        if (version_compare(phpversion('redis'), '4.0.0') > 0) {
            try {
                $this->connect($client, $host, $port);
            } catch (RedisException $e) {
                throw new Exception($e->getMessage(), 0, $e);
            }
        } elseif (!@$this->connect($client, $host, $port)) {
            throw new Exception(error_get_last()['message']);
        }

        parent::__construct($client);
    }

    private function connect(Client $client, ?string $host, ?int $port) : bool
    {
        return $client->connect($host ?? '127.0.0.1', $port ?? 6379);
    }
}
