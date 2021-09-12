<?php



class RolesViewList extends ViewList
{
 	public function preDisplay()
 	{
 		$this->lv = new ListViewSmarty();
 		$this->lv->showMassupdateFields = false;
 	}
}
