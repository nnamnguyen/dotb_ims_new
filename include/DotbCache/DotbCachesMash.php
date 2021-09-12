<?php


/**
 * @deprecated
 */
class DotbCachesMash extends DotbCacheAbstract
{
    /**
     * @see DotbCacheAbstract::$_priority
     */
    protected $_priority = 950;
    
    /**
     * @see DotbCacheAbstract::useBackend()
     */
    public function useBackend()
    {
        if ( !parent::useBackend() )
            return false;
        
        if ( function_exists("zget")
                && empty($GLOBALS['dotb_config']['external_cache_disabled_smash']))
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
        zput('/tmp/'.$this->_keyPrefix.'/'.$key, $value, $this->_expireTimeout);
    }
    
    /**
     * @see DotbCacheAbstract::_getExternal()
     */
    protected function _getExternal(
        $key
        )
    {
        return zget('/tmp/'.$this->_keyPrefix.'/'.$key,null);
    }
    
    /**
     * @see DotbCacheAbstract::_clearExternal()
     */
    protected function _clearExternal(
        $key
        )
    {
        zdelete('/tmp/'.$this->_keyPrefix.'/'.$key);
    }
    
    /**
     * @see DotbCacheAbstract::_resetExternal()
     */
    protected function _resetExternal()
    {
        zdelete('/tmp/'.$this->_keyPrefix.'/');
    }
}
