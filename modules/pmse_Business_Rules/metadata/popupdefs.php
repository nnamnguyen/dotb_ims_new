<?php


$module_name = 'pmse_Business_Rules';
$object_name = 'pmse_Business_Rules';
$_module_name = 'pmse_business_rules';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
						);
