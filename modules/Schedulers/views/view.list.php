<?php



class SchedulersViewList extends ViewList
{
 	public function display()
 	{
 		parent::display();
 		$this->seed->displayCronInstructions();
 	}
}
