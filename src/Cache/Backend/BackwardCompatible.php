<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Cache\Backend;

use Psr\SimpleCache\CacheInterface;
use Dotbcrm\Dotbcrm\Cache\Exception;
use DotbCache;
use DotbCacheAbstract;

/**
 * Backward compatible cache adapter
 */
final class BackwardCompatible implements CacheInterface
{
    /**
     * Cached backend
     *
     * @var DotbCacheAbstract
     */
    private $backend;

    /**
     * @codeCoverageIgnore
     *
     * @param DotbCacheAbstract $backend
     *
     * @throws Exception
     */
    public function __construct(DotbCacheAbstract $backend)
    {
        if (!$backend->useBackend()) {
            throw new Exception(sprintf('The %s backend is unavailable', $backend));
        }

        $this->backend = $backend;
    }

    /**
     * {@inheritDoc}
     */
    public function get($key, $default = null)
    {
        $value = $this->backend->get($key);

        if ($value === null) {
            return $default;
        }

        if ($value === DotbCache::EXTERNAL_CACHE_NULL_VALUE) {
            return null;
        }

        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value, $ttl = null)
    {
        $this->backend->set($key, $value, $ttl);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key)
    {
        $this->backend->__unset($key);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->backend->flush();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getMultiple($keys, $default = null)
    {
        foreach ($keys as $key) {
            yield $key => $this->get($key, $default);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setMultiple($values, $ttl = null)
    {
        $result = true;

        foreach ($values as $key => $value) {
            $result = $this->set($key, $value, $ttl) && $result;
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteMultiple($keys)
    {
        $result = true;

        foreach ($keys as $key) {
            $result = $this->delete($key) && $result;
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function has($key)
    {
        return $this->backend->get($key) !== null;
    }
}
