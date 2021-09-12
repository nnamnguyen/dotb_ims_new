<?php




class ReportsViewClassic extends ViewClassic
{
 	/**
	 * @see DotbView::preDisplay()
	 */
	public function preDisplay()
 	{
 		if(!empty($this->view_object_map['action']))
 			$this->action = $this->view_object_map['action'];
 	}
 	
 	/**
	 * @see DotbView::display()
	 */
	public function display()
 	{
 		parent::display();
 		$this->action = $GLOBALS['action'];	
 	}	
}
