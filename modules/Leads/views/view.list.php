<?php



class LeadsViewList extends ViewList
{
 	public function preDisplay()
 	{

 		parent::preDisplay();
 		$this->lv->targetList = true;
 	}
}
