<?php



class ViewPortalStyleUpload extends DotbView 
{
    /**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
    	return array(
    	   translate('LBL_MODULE_NAME','Administration'),
    	   ModuleBuilderController::getModuleTitle(),
    	   );
    }

	// DO NOT REMOVE - overrides parent ViewEdit preDisplay() which attempts to load a bean for a non-existent module
	function preDisplay() 
	{
	}

	function display() 
	{
		$this->ss->assign('mod', $GLOBALS['mod_strings']);
		$this->ss->display('modules/ModuleBuilder/tpls/portalstyle_uploaded.tpl');
	}
}