<?php

$module_name = 'fte_UsageTracking';
$object_name = 'fte_UsageTracking';
$_module_name = 'fte_usagetracking';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
						);
