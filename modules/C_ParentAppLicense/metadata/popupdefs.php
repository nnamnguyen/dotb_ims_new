<?php

$module_name = 'C_ParentAppLicense';
$object_name = 'C_ParentAppLicense';
$_module_name = 'c_parentapplicense';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
						);
