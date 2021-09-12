<?php


/*********************************************************************************
 * $Id: view.detail.php 
 * Description: This file is used to override the default Meta-data EditView behavior
 * to provide customization specific to the Calls module.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

class ProjectTaskViewEdit extends ViewEdit 
{
    /**
 	 * @see DotbView::display()
 	 */
 	public function display() 
 	{
		global $beanFiles;
		require_once($beanFiles['ProjectTask']);
		
		$focus = BeanFactory::newBean('ProjectTask');
		if (isset($_REQUEST['record'])){
			$focus->retrieve($_REQUEST['record']);
		}
		

		$this->ss->assign('resource', $focus->getResourceName());
		
		if (isset($_REQUEST['fromGrid']) && $_REQUEST['fromGrid'] == '1'){
			$this->ss->assign('project_id', $focus->project_id);
			$this->ss->assign('FROM_GRID', true);
		}
		else{
			$this->ss->assign('FROM_GRID', false);
		}
		
 		parent::display();
 	}
}
