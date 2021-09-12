<?php



class ViewPortalTheme extends DotbView
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

    /**
     * This function loads portal config vars from db and sets them for the view
     * @see DotbView::display() for more info
   	 */
	function display() 
	{
        global $current_user, $app_strings;

        $smarty = new Dotb_Smarty();
        $smarty->assign('mod', $GLOBALS['mod_strings']);
        $smarty->assign("token", session_id());
        $smarty->assign("siteURL", $GLOBALS['dotb_config']['site_url']);

        //Loading label
        $smarty->assign('LBL_LOADING', $app_strings['LBL_ALERT_TITLE_LOADING']);

        $theme = new LumiaTheme();
        $smarty->assign("css_url", $theme->getCSSURL());


        $ajax = new AjaxCompose();
        $ajax->addCrumb(translate('LBL_DOTBPORTAL', 'ModuleBuilder'), 'ModuleBuilder.main("dotbportal")');
        $ajax->addCrumb(ucwords(translate('LBL_PORTAL_THEME')), '');
        $ajax->addSection('center', translate('LBL_DOTBPORTAL', 'ModuleBuilder'), $smarty->fetch('modules/ModuleBuilder/tpls/portaltheme.tpl'));
        echo $ajax->getJavascript();
	}
}
