<?php

require_once('modules/Teams/Popup_picker.php');
class TeamsViewPopup extends DotbView
{
	var $type ='list';

	function display(){
		if(DotbAutoLoader::existing('modules/' . $this->module . '/Popup_picker.php')){
			require_once('modules/' . $this->module . '/Popup_picker.php');
		}else{
			require_once('include/Popups/Popup_picker.php');
		}

		$popup = new Popup_Picker();
		$popup->_hide_clear_button = true;
		if(!empty($_REQUEST['html'])){
			$method = $_REQUEST['html'];
			if(method_exists($popup, $method)){
				echo $popup->$method();
				return;
			}
		}
		echo $popup->process_page();
	}
}