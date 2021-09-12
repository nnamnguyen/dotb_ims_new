<?php


/**
 * @deprecated
 */
class DotbCacheZend extends DotbCacheAbstract
{
    /**
     * @see DotbCacheAbstract::$_priority
     */
    protected $_priority = 910;

    /**
     * @see DotbCacheAbstract::useBackend()
     */
    public function useBackend()
    {
        if ( !parent::useBackend() )
            return false;

        if ( function_exists("zend_shm_cache_fetch")
                && empty($GLOBALS['dotb_config']['external_cache_disabled_zend']))
            return true;

        return false;
    }

    /**
     * @see DotbCacheAbstract::_setExternal()
     */
    protected function _setExternal(
        $key,
        $value
        )
    {
        zend_shm_cache_store($key,serialize($value),$this->_expireTimeout);
    }

    /**
     * @see DotbCacheAbstract::_getExternal()
     */
    protected function _getExternal(
        $key
        )
    {
        $raw_cache_value = zend_shm_cache_fetch($key);
        if($raw_cache_value === false) {
            return null;
        }
        return is_string($raw_cache_value) ?
            unserialize($raw_cache_value) :
            $raw_cache_value;
    }

    /**
     * @see DotbCacheAbstract::_clearExternal()
     */
    protected function _clearExternal(
        $key
        )
    {
        zend_shm_cache_delete($key);
    }

    /**
     * @see DotbCacheAbstract::_resetExternal()
     */
    protected function _resetExternal()
    {
        zend_shm_cache_clear();
    }
}
