<?php


class ViewDropdowns extends DotbView
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
		$ajax = new AjaxCompose();
		$smarty = new Dotb_Smarty();
		
 		if (isset($_REQUEST['refreshTree']))
		{
			$mbt = new DropDownTree();
			$ajax->addSection('west', $mbt->getName(), $mbt->fetchNodes());
			$smarty->assign('refreshTree',true);
		}
                
        global $mod_strings;
        $ajax->addCrumb($mod_strings['LBL_DROPDOWNEDITOR'], 'ModuleBuilder.main("dropdowns")');
        
        $dd = new DropDownBrowser();
        
        $smarty->assign('LBL_BTN_ADDDROPDOWN',translate('LBL_BTN_ADDDROPDOWN'));
        $smarty->assign('dropdowns', $dd->getNodes());
		$smarty->assign('deleteImage', DotbThemeRegistry::current()->getImage( 'delete_inline', '',null,null,'.gif',$mod_strings['LBL_MB_DELETE']));
		$smarty->assign('editImage', DotbThemeRegistry::current()->getImage( 'edit_inline', '',null,null,'.gif',$mod_strings['LBL_EDIT']));
		$smarty->assign('action', 'savedropdown');
		

		$ajax->addSection('center', $GLOBALS['mod_strings']['LBL_DROPDOWNEDITOR'], $smarty->fetch('modules/ModuleBuilder/tpls/MBModule/dropdowns.tpl') );
 		echo $ajax->getJavascript();
 	}
}