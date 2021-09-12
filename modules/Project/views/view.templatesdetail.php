<?php




class ProjectViewTemplatesDetail extends ViewDetail 
{
 	/**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
    	return array(
    	   $this->_getModuleTitleListParam($browserTitle),
    	   "<a href='index.php?module=Project&action=EditView&record={$this->bean->id}'>{$this->bean->name}</a>",
    	   $mod_strings['LBL_PROJECT_TEMPLATE']
    	   );
    }
    
	function display() 
	{
 		global $beanFiles;
		require_once($beanFiles['Project']);

		$focus = BeanFactory::getBean('Project', $_REQUEST['record']);

		global $app_list_strings, $current_user, $mod_strings;
		$this->ss->assign('APP_LIST_STRINGS', $app_list_strings);

		if($current_user->id == $focus->assigned_user_id || $current_user->is_admin){
			$this->ss->assign('OWNER_ONLY', true);
		}
		else{
			$this->ss->assign('OWNER_ONLY', false);
		}

		if(ACLController::checkAccess('ProjectTask', 'edit', true)) {
			$this->ss->assign('EDIT_RIGHTS_ONLY', true);
		}
		else{
			$this->ss->assign('EDIT_RIGHTS_ONLY', false);
		}

		$this->ss->assign('SAVE_AS', $mod_strings['LBL_SAVE_AS_PROJECT']);
		$this->ss->assign("IS_TEMPLATE", 1);
 		parent::display();
 	}

 	/**
     * @see DotbView::_displaySubPanels()
     */
    protected function _displaySubPanels()
    {
   	 	$subpanel = new SubPanelTiles( $this->bean, 'ProjectTemplates' );
    	echo $subpanel->display( true, true );
    }

}
