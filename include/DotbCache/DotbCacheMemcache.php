<?php


/**
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\Memcached instead
 */
class DotbCacheMemcache extends DotbCacheAbstract
{
    /**
     * @var Memcache server name string
     */
    protected $_host = '127.0.0.1';

    /**
     * @var Memcache server port int
     */
    protected $_port = 11211;

    /**
     * @var Memcache object
     */
    protected $_memcache = '';

    /**
     * @see DotbCacheAbstract::$_priority
     */
    protected $_priority = 900;

    /**
     * Minimal data size to be compressed
     * @var int
     */
    protected $min_compress = 512;
    /**
     * @see DotbCacheAbstract::useBackend()
     */
    public function useBackend()
    {
        // parent check
        if (!parent::useBackend()) {
            return false;
        }

        if ( extension_loaded('memcache')
                && empty($GLOBALS['dotb_config']['external_cache_disabled_memcache'])
                && $this->_getMemcacheObject() )
            return true;

        return false;
    }

    /**
     * @see DotbCacheAbstract::__construct()
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the memcache object; initialize if needed
     */
    protected function _getMemcacheObject()
    {
        if ( !($this->_memcache instanceOf Memcache) ) {
            $this->_memcache = new Memcache();
            $config = DotbConfig::getInstance();
            $this->_host = $config->get('external_cache.memcache.host', $this->_host);
            $this->_port = $config->get('external_cache.memcache.port', $this->_port);
            if ( !@$this->_memcache->connect($this->_host,$this->_port) ) {
                return false;
            }
            if($config->get('external_cache.memcache.disable_compression', false)) {
                $this->_memcache->setCompressThreshold($config->get('external_cache.memcache.min_compression', $this->min_compress));
            } else {
                $this->_memcache->setCompressThreshold(0);
            }
        }

        return $this->_memcache;
    }

    /**
     * @see DotbCacheAbstract::_setExternal()
     */
    protected function _setExternal(
        $key,
        $value
        )
    {
        $this->_getMemcacheObject()->set($key, $value, 0, $this->_expireTimeout);
    }

    /**
     * @see DotbCacheAbstract::_getExternal()
     */
    protected function _getExternal(
        $key
        )
    {
        $returnValue = $this->_getMemcacheObject()->get($key);
        if ( $returnValue === false ) {
            return null;
        }

        return $returnValue;
    }

    /**
     * @see DotbCacheAbstract::_clearExternal()
     */
    protected function _clearExternal(
        $key
        )
    {
        $this->_getMemcacheObject()->delete($key);
    }

    /**
     * @see DotbCacheAbstract::_resetExternal()
     */
    protected function _resetExternal()
    {
        $this->_getMemcacheObject()->flush();
    }
}
