<?php


function additionalDetailsNote($fields) {
	static $mod_strings;
	global $app_strings;
	if(empty($mod_strings)) {
		global $current_language;
		$mod_strings = return_module_language($current_language, 'Notes');
	}
		
	$overlib_string = '';
	
	if(!empty($fields['TEAM_NAME'])) $overlib_string .= '<b>'. $app_strings['LBL_TEAM'] . '</b> ' . $fields['TEAM_NAME'] . '<br>';
	if(!empty($fields['DESCRIPTION'])) { 
		$overlib_string .= '<b>'. $mod_strings['LBL_NOTE'] . '</b> ' . substr($fields['DESCRIPTION'], 0, 300);
		if(strlen($fields['DESCRIPTION']) > 300) $overlib_string .= '...';
		$overlib_string .= '<br>';
	}
	
	return array('fieldToAddTo' => 'NAME', 
				 'string' => $overlib_string, 
				 'editLink' => "index.php?action=EditView&module=Notes&return_module=Notes&record={$fields['ID']}", 
				 'viewLink' => "index.php?action=DetailView&module=Notes&return_module=Notes&record={$fields['ID']}");
}
 
 ?>
 
 