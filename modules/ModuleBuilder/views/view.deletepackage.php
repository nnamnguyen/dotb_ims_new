<?php

require_once('modules/ModuleBuilder/MB/ModuleBuilder.php');

class Viewdeletepackage extends DotbView
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
        global $mod_strings;

        $package = $this->request->getValidInputRequest('package', 'Assert\ComponentName');
        $ajax = new AjaxCompose();
        $ajax->addSection(
            'center',
            $mod_strings['LBL_PACKAGE_DELETED'],
            str_replace('[[package]]', $package, $mod_strings['LBL_PACKAGE_WAS_DELETED'])
        );
        echo $ajax->getJavascript();
 	}
}