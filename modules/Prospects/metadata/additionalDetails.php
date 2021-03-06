<?php


function additionalDetailsProspect($fields) {
	static $mod_strings;
	if(empty($mod_strings)) {
		global $current_language;
		$mod_strings = return_module_language($current_language, 'Prospects');
	}
		
	$overlib_string = '';
	
	if(!empty($fields['ACCOUNT_NAME'])) $overlib_string .= '<b>'. $mod_strings['LBL_EDIT_ACCOUNT_NAME'] . '</b> ' . $fields['ACCOUNT_NAME'] . '<br>';
	if(!empty($fields['PRIMARY_ADDRESS_STREET']) || !empty($fields['PRIMARY_ADDRESS_CITY']) ||
		!empty($fields['PRIMARY_ADDRESS_STATE']) || !empty($fields['PRIMARY_ADDRESS_POSTALCODE']) ||
		!empty($fields['PRIMARY_ADDRESS_COUNTRY']))
			$overlib_string .= '<b>' . $mod_strings['LBL_PRIMARY_ADDRESS'] . '</b><br>';
	if(!empty($fields['PRIMARY_ADDRESS_STREET'])) $overlib_string .= $fields['PRIMARY_ADDRESS_STREET'] . '<br>';
	if(!empty($fields['PRIMARY_ADDRESS_STREET_2'])) $overlib_string .= $fields['PRIMARY_ADDRESS_STREET_2'] . '<br>';
	if(!empty($fields['PRIMARY_ADDRESS_STREET_3'])) $overlib_string .= $fields['PRIMARY_ADDRESS_STREET_3'] . '<br>';
	if(!empty($fields['PRIMARY_ADDRESS_CITY'])) $overlib_string .= $fields['PRIMARY_ADDRESS_CITY'] . ', ';
	if(!empty($fields['PRIMARY_ADDRESS_STATE'])) $overlib_string .= $fields['PRIMARY_ADDRESS_STATE'] . ' ';
	if(!empty($fields['PRIMARY_ADDRESS_POSTALCODE'])) $overlib_string .= $fields['PRIMARY_ADDRESS_POSTALCODE'] . ' ';
	if(!empty($fields['PRIMARY_ADDRESS_COUNTRY'])) $overlib_string .= $fields['PRIMARY_ADDRESS_COUNTRY'] . '<br>';
	if(strlen($overlib_string) > 0 && !(strrpos($overlib_string, '<br>') == strlen($overlib_string) - 4)) 
		$overlib_string .= '<br>';  
	if(!empty($fields['PHONE_MOBILE'])) $overlib_string .= '<b>'. $mod_strings['LBL_MOBILE_PHONE'] . '</b> <span class="phone">' . $fields['PHONE_MOBILE'] . '</span><br>';
	if(!empty($fields['PHONE_HOME'])) $overlib_string .= '<b>'. $mod_strings['LBL_HOME_PHONE'] . '</b> <span class="phone">' . $fields['PHONE_HOME'] . '</span><br>';
	if(!empty($fields['PHONE_OTHER'])) $overlib_string .= '<b>'. $mod_strings['LBL_OTHER_PHONE'] . '</b> <span class="phone">' . $fields['PHONE_OTHER'] . '</span><br>';

	if(!empty($fields['EMAIL1'])) 
		$overlib_string .= '<b>'. $mod_strings['LBL_EMAIL_ADDRESS'] . '</b> ' . 
								 "<a href=index.php?module=Emails&action=Compose&contact_id={$fields['ID']}&" .
								 "parent_type=Contacts&parent_id={$fields['ID']}&to_addrs_ids={$fields['ID']}&to_addrs_names" .
								 "={$fields['FIRST_NAME']}&nbsp;{$fields['LAST_NAME']}&to_addrs_emails={$fields['EMAIL1']}&" .
								 "to_email_addrs=" . urlencode("{$fields['FIRST_NAME']} {$fields['LAST_NAME']} <{$fields['EMAIL1']}>") .
								 "&return_module=Contacts&return_action=ListView'>{$fields['EMAIL1']}</a><br>";
	if(!empty($fields['EMAIL2'])) 
		$overlib_string .= '<b>'. $mod_strings['LBL_OTHER_EMAIL_ADDRESS'] . '</b> ' . 
								 "<a href=index.php?module=Emails&action=Compose&contact_id={$fields['ID']}&" .
								 "parent_type=Contacts&parent_id={$fields['ID']}&to_addrs_ids={$fields['ID']}&to_addrs_names" .
								 "={$fields['FIRST_NAME']}&nbsp;{$fields['LAST_NAME']}&to_addrs_emails={$fields['EMAIL2']}&" .
								 "to_email_addrs=" . urlencode("{$fields['FIRST_NAME']} {$fields['LAST_NAME']} <{$fields['EMAIL2']}>") .
								 "&return_module=Contacts&return_action=ListView'>{$fields['EMAIL2']}</a><br>";
	
	if(!empty($fields['DESCRIPTION'])) { 
		$overlib_string .= '<b>'. $mod_strings['LBL_DESCRIPTION'] . '</b> ' . substr($fields['DESCRIPTION'], 0, 300);
		if(strlen($fields['DESCRIPTION']) > 300) $overlib_string .= '...';
	}	
	
	return array('fieldToAddTo' => 'FULL_NAME', 
				 'string' => $overlib_string, 
				 'editLink' => "index.php?action=EditView&module=Prospects&return_module=Prospects&record={$fields['ID']}", 
				 'viewLink' => "index.php?action=DetailView&module=Prospects&return_module=Prospects&record={$fields['ID']}");
	
}
 
 ?>
 
