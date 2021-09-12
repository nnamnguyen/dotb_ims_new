<?php

$module_name = 'Notifications';
$_module_name = 'notifications';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $module_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
						);
?>
 
 
