<?php



class ViewDisplaydeploy extends DotbView 
{
    public function __construct()
	{
        parent::__construct();

        $name = $this->request->getValidInputRequest('name', 'Assert\ComponentName');
		$smarty = new Dotb_Smarty();
        $smarty->assign('package', $name);
		$smarty->assign('message', $GLOBALS['mod_strings']['LBL_DEPLOY_IN_PROGRESS']);
		$ajax = new AjaxCompose();
		$ajax->addCrumb($GLOBALS['mod_strings']['LBL_MODULEBUILDER'], 'ModuleBuilder.main("mb")');
        $ajax->addCrumb($name, 'ModuleBuilder.getContent(' . json_encode(http_build_query(array(
            'module' => 'ModuleBuilder',
            'action' => 'package',
            'package' => $name,
        ))) . ')');
		$ajax->addCrumb(translate('LBL_SECTION_DEPLOY', 'ModuleBuilder'), '');
		$ajax->addSection('center', translate('LBL_SECTION_DEPLOY', 'ModuleBuilder'), $smarty->fetch('modules/ModuleBuilder/tpls/MBPackage/deploy.tpl'));
		echo $ajax->getJavascript();
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
}
