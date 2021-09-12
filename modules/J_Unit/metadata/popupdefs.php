<?php

$module_name = 'J_Unit';
$object_name = 'J_Unit';
$_module_name = 'j_unit';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
						);
