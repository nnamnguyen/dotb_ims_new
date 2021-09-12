<?php



class ViewModifyDisplay extends DotbView 
{   
 	/**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
    	return array(
    	   "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>",
    	   "<a href='index.php?module=Connectors&action=ConnectorSettings'>".$mod_strings['LBL_ADMINISTRATION_MAIN']."</a>",
    	   $mod_strings['LBL_MODIFY_DISPLAY_TITLE']
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
        require_once('include/connectors/utils/ConnectorUtils.php');
        $connectors = ConnectorUtils::getConnectors(true);
        foreach($connectors as $id=>$source)
        {
            $s = SourceFactory::getSource($id);
            if(!$s->isEnabledInAdminDisplay())
            {
                unset($connectors[$id]);
            }
        }
    	$this->ss->assign('SOURCES', $connectors);
    	$this->ss->assign('mod', $GLOBALS['mod_strings']);
    	$this->ss->assign('APP', $GLOBALS['app_strings']);
    	$this->ss->assign('theme', $GLOBALS['theme']);

  		echo $this->getModuleTitle(false);
    	$this->ss->display($this->getCustomFilePathIfExists('modules/Connectors/tpls/modify_display.tpl'));
    }
}
