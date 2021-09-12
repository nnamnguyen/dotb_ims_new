<?php


/**
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\APCu instead
 */
class DotbCacheAPC extends DotbCacheAbstract
{
    /**
     * @see DotbCacheAbstract::$_priority
     */
    protected $_priority = 940;

    /**
     * @see DotbCacheAbstract::useBackend()
     */
    public function useBackend()
    {
        if (!parent::useBackend()) {
            return false;
        }

        if (!empty($GLOBALS['dotb_config']['external_cache_disabled_apc'])) {
            return false;
        }

        if (!extension_loaded('apc')) {
            return false;
        }

        if (!ini_get('apc.enabled')) {
            return false;
        }

        if (php_sapi_name() === 'cli' && !ini_get('apc.enable_cli')) {
            return false;
        }

        return true;
    }

    /**
     * @see DotbCacheAbstract::_setExternal()
     */
    protected function _setExternal($key,$value)
    {
        apc_store($key,$value,$this->_expireTimeout);
    }

    /**
     * @see DotbCacheAbstract::_getExternal()
     */
    protected function _getExternal($key)
    {
        $res = apc_fetch($key);
        if($res === false) {
            return null;
        }

        return $res;
    }

    /**
     * @see DotbCacheAbstract::_clearExternal()
     */
    protected function _clearExternal($key)
    {
        apc_delete($key);
    }

    /**
     * @see DotbCacheAbstract::_resetExternal()
     */
    protected function _resetExternal()
    {
        apc_clear_cache('user');
    }
}
