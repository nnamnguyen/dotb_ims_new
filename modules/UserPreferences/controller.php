<?php


class UserPreferencesController extends DotbController
{
	function action_save_rich_text_preferences() {
        $this->view = 'ajax';
        global $current_user;
        if(!empty($current_user)) {
           $height = isset($_REQUEST['height']) ? $_REQUEST['height'] : '325px';
           $width =  isset($_REQUEST['width']) ? $_REQUEST['width'] : '95%';
           $current_user->setPreference('text_editor_height', $height);
           $current_user->setPreference('text_editor_width', $width);
           $current_user->savePreferencesToDB();
		   $json = getJSONobj();
		   $retArray = array();
		   $retArray['height'] = $height;
		   $retArray['width'] = $width;
		   header("Content-Type: application/json");
		   echo $json->encode($retArray);
        }
	}
	
}
?>
