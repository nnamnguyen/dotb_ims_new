<?php


/**
 * @deprecated Use Dotbcrm\Dotbcrm\Cache\Backend\InMemory instead
 */
class DotbCacheMemory extends DotbCacheAbstract
{
    /**
     * @see DotbCacheAbstract::$_priority
     */
    protected $_priority = 999;
    
    /**
     * @see DotbCacheAbstract::useBackend()
     */
    public function useBackend()
    {
        // we'll always have this backend available
        return true;
    }
    
    /**
     * @see DotbCacheAbstract::_setExternal()
     *
     * Does nothing; cache is gone after request is done.
     */
    protected function _setExternal($key,$value)
    {
    }
    
    /**
     * @see DotbCacheAbstract::_getExternal()
     *
     * Does nothing; cache is gone after request is done.
     */
    protected function _getExternal($key)
    {
    }
    
    /**
     * @see DotbCacheAbstract::_clearExternal()
     *
     * Does nothing; cache is gone after request is done.
     */
    protected function _clearExternal($key)
    {
    }
    
    /**
     * @see DotbCacheAbstract::_resetExternal()
     *
     * Does nothing; cache is gone after request is done.
     */
    protected function _resetExternal()
    {
    }
}
