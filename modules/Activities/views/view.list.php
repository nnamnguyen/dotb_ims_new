<?php



class ActivitiesViewList extends ViewList
{
 	public function display()
 	{
 		$GLOBALS['mod_strings'] = return_module_language($GLOBALS['current_language'], 'Calendar');
 		require_once('modules/Calendar/index.php');
 	}
}
