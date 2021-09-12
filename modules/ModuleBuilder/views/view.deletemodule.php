<?php

require_once('modules/ModuleBuilder/MB/ModuleBuilder.php');
 
class Viewdeletemodule extends DotbView
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

	function display()
	{

		$module = $this->request->getValidInputRequest('module', 'Assert\ComponentName');
		$package = $this->request->getValidInputRequest('package', 'Assert\ComponentName');
		$ajax = new AjaxCompose();
		$ajax->addSection('center', 'Module Deleted', $module . ' was deleted from ' . $package);
		echo $ajax->getJavascript(); 
 	}
}