<?php


$module_name = 'pmse_Emails_Templates';
$object_name = 'pmse_Emails_Templates';
$_module_name = 'pmse_emails_templates';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
						);
