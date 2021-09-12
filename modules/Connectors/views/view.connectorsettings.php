<?php


class ViewConnectorSettings extends DotbView 
{
 	/**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
    	return array(
    	   "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>",
    	   $mod_strings['LBL_ADMINISTRATION_MAIN']
    	   );
    }
    
    /**
	 * @see DotbView::_getModuleTab()
	 */
	protected function _getModuleTab()
    {
        return 'Administration';
    }
    
    /**
	 * @see DotbView::display()
	 */
	public function display() 
    {
		global $mod_strings, $app_strings;
		
		echo $this->getModuleTitle(false);
		
		$this->ss->assign('mod', $mod_strings);
		$this->ss->assign('app', $app_strings);
		$this->ss->assign('IMG', 'themes/default/images/');
		$this->ss->display($this->getCustomFilePathIfExists('modules/Connectors/tpls/administration.tpl'));
    }
}
