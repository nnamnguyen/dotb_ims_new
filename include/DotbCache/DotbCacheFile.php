<?php


/**
 * @deprecated
 */
class DotbCacheFile extends DotbCacheAbstract
{
    /**
     * @var path and file which will store the cache used for this backend
     */
    protected $_cacheFileName = 'externalCache.php';

    /**
     * @var bool true if the cache has changed and needs written to disk
     */
    protected $_cacheChanged = false;

    /**
     * @see DotbCacheAbstract::$_priority
     */
    protected $_priority = 990;

    /**
     * @see DotbCacheAbstract::useBackend()
     */
    public function useBackend()
    {
        if ( !parent::useBackend() )
            return false;

        if ( !empty($GLOBALS['dotb_config']['external_cache_enabled_file']) )
            return true;

        return false;
    }

    /**
     * @see DotbCacheAbstract::__construct()
     *
     * For this backend, we'll read from the DotbCacheFile::_cacheFileName file into
     * the DotbCacheFile::$localCache array.
     */
    public function __construct()
    {
        parent::__construct();

        if ( isset($GLOBALS['dotb_config']['external_cache_filename']) )
            $this->_cacheFileName = $GLOBALS['dotb_config']['external_cache_filename'];
    }

    /**
     * @see DotbCacheAbstract::__destruct()
     *
     * For this backend, we'll write the DotbCacheFile::$localCache array serialized out to a file
     */
    public function __destruct()
    {
        parent::__destruct();

        if ( $this->_cacheChanged )
            dotb_file_put_contents_atomic(dotb_cached($this->_cacheFileName), serialize($this->_localStore));
    }

    /**
	 * This is needed to prevent unserialize vulnerability
     */
    public function __wakeup()
    {
        // clean all properties
        foreach(get_object_vars($this) as $k => $v) {
            $this->$k = null;
        }
        throw new Exception("Not a serializable object");
    }

    /**
     * @see DotbCacheAbstract::_setExternal()
     *
     * Does nothing; we write to cache on destroy
     */
    protected function _setExternal(
        $key,
        $value
        )
    {
        $this->_cacheChanged = true;
    }

    /**
     * @see DotbCacheAbstract::_getExternal()
     */
    protected function _getExternal(
        $key
        )
    {
        // load up the external cache file
        if ( dotb_is_file($cachedfile = dotb_cached($this->_cacheFileName)))
            $this->_localStore = unserialize(file_get_contents($cachedfile));

        if ( isset($this->_localStore[$key]) )
            return $this->_localStore[$key];

        return null;
    }

    /**
     * @see DotbCacheAbstract::_clearExternal()
     *
     * Does nothing; we write to cache on destroy
     */
    protected function _clearExternal(
        $key
        )
    {
        $this->_cacheChanged = true;
    }

    /**
     * @see DotbCacheAbstract::_resetExternal()
     *
     * Does nothing; we write to cache on destroy
     */
    protected function _resetExternal()
    {
        $this->_cacheChanged = true;
    }
}
