<?php



class ProspectsViewList extends ViewList
{
 	public function preDisplay()
 	{
 		parent::preDisplay();
 		$this->lv->targetList = true;
 	}
}
