<?php



class ViewPortalSync extends DotbView 
{
    public function __construct()
	{
	    $GLOBALS['log']->debug('ViewPortalSync constructor');
        parent::__construct();
	}

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
        $smarty = new Dotb_Smarty();
        $smarty->assign('welcome', $GLOBALS['mod_strings']['LBL_SYNCP_WELCOME']);
        $smarty->assign('mod', $GLOBALS['mod_strings']);
        $label = $this->request->getValidInputRequest('label');
        if ($label !== null) {
            $smarty->assign('label', $label);
        }
        $options = (!empty($GLOBALS['system_config']->settings['system_portal_url'])) ? $GLOBALS['system_config']->settings['system_portal_url'] : 'https://';
        $smarty->assign('options',$options);
        $ajax = new AjaxCompose();
        $ajax->addCrumb(translate('LBL_DOTBPORTAL', 'ModuleBuilder'), 'ModuleBuilder.main("dotbportal")');
        $ajax->addCrumb(translate('LBL_SYNCPORTAL', 'ModuleBuilder'), 'ModuleBuilder.getContent("module=ModuleBuilder&action=portalsync")');
        $ajax->addSection('center', translate('LBL_SYNCPORTAL', 'ModuleBuilder'), $smarty->fetch('modules/ModuleBuilder/tpls/portalsync.tpl'));
		$GLOBALS['log']->debug($smarty->fetch('modules/ModuleBuilder/tpls/portalsync.tpl'));
        echo $ajax->getJavascript();
	}
}
