<?php


/*********************************************************************************
 * $Id: view.detail.php 
 * Description: This file is used to override the default Meta-data EditView behavior
 * to provide customization specific to the Calls module.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class ProjectTaskViewDetail extends ViewDetail 
{
    /**
 	 * @see DotbView::display()
 	 */
 	public function display() 
 	{
		global $beanFiles;
		require_once($beanFiles['ProjectTask']);
		
		$focus = BeanFactory::getBean('ProjectTask', $_REQUEST['record']);
		
		$this->ss->assign('resource', $focus->getResourceName());
		
 		parent::display();
 	}
}
