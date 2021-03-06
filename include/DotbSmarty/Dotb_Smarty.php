<?php



if(!defined('DOTB_SMARTY_DIR'))
{
	define('DOTB_SMARTY_DIR', dotb_cached('smarty/'));
}

/**
 * Smarty wrapper for Dotb
 * @api
 */
class Dotb_Smarty extends Smarty
{
    protected static $_plugins_dir;
    public function __construct()
	{
		if(!file_exists(DOTB_SMARTY_DIR))mkdir_recursive(DOTB_SMARTY_DIR, true);
		if(!file_exists(DOTB_SMARTY_DIR . 'templates_c'))mkdir_recursive(DOTB_SMARTY_DIR . 'templates_c', true);
		if(!file_exists(DOTB_SMARTY_DIR . 'configs'))mkdir_recursive(DOTB_SMARTY_DIR . 'configs', true);
		if(!file_exists(DOTB_SMARTY_DIR . 'cache'))mkdir_recursive(DOTB_SMARTY_DIR . 'cache', true);

		$this->template_dir = '.';
		$this->compile_dir = DOTB_SMARTY_DIR . 'templates_c';
		$this->config_dir = DOTB_SMARTY_DIR . 'configs';
		$this->cache_dir = DOTB_SMARTY_DIR . 'cache';
		$this->request_use_auto_globals = true; // to disable Smarty from using long arrays
        // Smarty will create subdirectories under the compiled templates and cache directories
        $this->use_sub_dirs = true;

        if(empty(self::$_plugins_dir)) {
            self::$_plugins_dir = array();
            if (file_exists('custom/include/DotbSmarty/plugins')) {
                self::$_plugins_dir[] = 'custom/include/DotbSmarty/plugins';
            }
            if (file_exists('custom/vendor/Smarty/plugins')) {
                self::$_plugins_dir[] = 'custom/vendor/Smarty/plugins';
            }
            self::$_plugins_dir[] = 'include/DotbSmarty/plugins';
            self::$_plugins_dir[] = 'vendor/Smarty/plugins';
        }
        $this->plugins_dir = self::$_plugins_dir;

		$this->assign("VERSION_MARK", getVersionedPath(''));
	}

	/**
	 * Fetch template or custom double
	 * @see Smarty::fetch()
     * @param string $resource_name
     * @param string $cache_id
     * @param string $compile_id
     * @param boolean $display
	 */
	public function fetchCustom($resource_name, $cache_id = null, $compile_id = null, $display = false)
	{
	    return $this->fetch(DotbAutoLoader::existingCustomOne($resource_name), $cache_id, $compile_id, $display);
	}

	/**
	 * Display template or custom double
	 * @see Smarty::display()
     * @param string $resource_name
     * @param string $cache_id
     * @param string $compile_id
	 */
	function displayCustom($resource_name, $cache_id = null, $compile_id = null)
	{
	    return $this->display(DotbAutoLoader::existingCustomOne($resource_name), $cache_id, $compile_id);
	}

	/**
	 * Override default _unlink method call to fix Bug 53010
	 *
	 * @param string $resource
     * @param integer $exp_time
     */
    function _unlink($resource, $exp_time = null)
    {
        if(file_exists($resource)) {
            return parent::_unlink($resource, $exp_time);
        }

        // file wasn't found, so it must be gone.
        return true;
    }
}
