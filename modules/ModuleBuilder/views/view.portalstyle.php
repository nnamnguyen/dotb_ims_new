<?php



class ViewPortalStyle extends DotbView 
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

	function display($params = array())
	{
        $smarty = new Dotb_Smarty();
        //$smarty->assign('welcome', $GLOBALS['mod_strings']['LBL_SP_UPLOADSTYLE']);
        $smarty->assign('mod', $GLOBALS['mod_strings']);
        $label = isset($params['label']) ? $params['label'] : $this->request->getValidInputRequest('label');
        if ($label !== null) {
            $GLOBALS['log']->debug('ViewPortalStyle->display(): label = ' . $label);
            $smarty->assign('label', $label);
        }
        $ajax = new AjaxCompose();
        $ajax->addCrumb(translate('LBL_DOTBPORTAL', 'ModuleBuilder'), 'ModuleBuilder.main("dotbportal")');
        $ajax->addCrumb(translate('LBL_UP_STYLE_SHEET', 'ModuleBuilder'), 'ModuleBuilder.getContent("module=ModuleBuilder&action=portalstyle")');
        $ajax->addSection('center', translate('LBL_UP_STYLE_SHEET', 'ModuleBuilder'), $smarty->fetch('modules/ModuleBuilder/tpls/portalstyle.tpl'));
		$GLOBALS['log']->debug('ViewPortalStyle->display(): '.$ajax->getJavascript());
		echo $ajax->getJavascript();
	}
}
