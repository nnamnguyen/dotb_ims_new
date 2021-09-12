<?php

 


function additionalDetailsProject($fields) {
	static $mod_strings;
	if(empty($mod_strings)) {
		global $current_language;
		$mod_strings = return_module_language($current_language, 'Project');
	}
		
	$overlib_string = '';
	
	if(!empty($fields['DESCRIPTION'])) {
		$overlib_string .= '<b>'. $mod_strings['LBL_DESCRIPTION'] . '</b> ' . substr($fields['DESCRIPTION'], 0, 300);
		if(strlen($fields['DESCRIPTION']) > 300) $overlib_string .= '...';
	}	

	return array('fieldToAddTo' => 'NAME', 
				 'string' => $overlib_string, 
				 'editLink' => "index.php?action=EditView&module=Project&return_module=Project&record={$fields['ID']}", 
				 'viewLink' => "index.php?action=DetailView&module=Project&return_module=Project&record={$fields['ID']}");
}
 
 ?>
 
 