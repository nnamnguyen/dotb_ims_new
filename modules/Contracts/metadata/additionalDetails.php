<?php



function additionalDetailsContract($fields) {
	static $mod_strings;

	if(empty($mod_strings)) {
		global $current_language;
		$mod_strings = return_module_language($current_language, 'Contracts');
	}
		
	$overlib_string = '';
		
	if(!empty($fields['REFERENCE_CODE'])) { 
		$overlib_string .= '<b>'. $mod_strings['LBL_REFERENCE_CODE'] . '</b> ' . substr($fields['REFERENCE_CODE'], 0, 300);
		if(strlen($fields['REFERENCE_CODE']) > 300) {
			$overlib_string .= '...';
		}
		$overlib_string .= '<br>';
	}		
	
	if(!empty($fields['DESCRIPTION'])) { 
		$overlib_string .= '<b>'. $mod_strings['LBL_DESCRIPTION'] . '</b> ' . substr($fields['DESCRIPTION'], 0, 300);
		if(strlen($fields['DESCRIPTION']) > 300) {
			$overlib_string .= '...';
		}
	}

	$ret_val = array (
		'fieldToAddTo' => 'NAME', 
		'string' => $overlib_string, 
		'width' => '400',
		'editLink' => "index.php?module=Contracts&action=EditView&record={$fields['ID']}&return_module=Contracts", 
		'viewLink' => "index.php?module=Contracts&action=DetailView&record={$fields['ID']}"
	);

	return $ret_val;
}
 
?>
