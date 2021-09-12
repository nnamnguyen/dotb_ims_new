<?php


class TasksViewEdit extends ViewEdit
{
    /**
 	 * @see DotbView::preDisplay()
 	 */
 	public function preDisplay()
 	{
 		if($_REQUEST['module'] != 'Tasks' && isset($_REQUEST['status']) && empty($_REQUEST['status'])) {
	       $this->bean->status = '';
 		} //if
 		if(!empty($_REQUEST['status']) && ($_REQUEST['status'] == 'Completed')) {
	       $this->bean->status = 'Completed';
 		}
 		parent::preDisplay();
 	}

 	/**
 	 * @see DotbView::display()
 	 */
 	public function display()
 	{
 		if($this->ev->isDuplicate){
	       $this->bean->status = $this->bean->getDefaultStatus();
 		} //if
 		parent::display();
 	}
}
