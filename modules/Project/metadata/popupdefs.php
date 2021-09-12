<?php


$popupMeta = array('moduleMain' => 'Project',
						'varName' => 'PROJECT',
						'orderBy' => 'name',
						'whereClauses' => 
							array('name' => 'project.name'),
						'whereStatement' => " project.is_template = 0 ",
						'searchInputs' =>
							array('name')
						);


?>
 
