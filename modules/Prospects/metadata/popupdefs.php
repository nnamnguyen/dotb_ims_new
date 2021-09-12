<?php


global $mod_strings;

$popupMeta = array('moduleMain' => 'Prospect',
						'varName' => 'PROSPECT',
						'orderBy' => 'prospects.last_name, prospects.first_name',
						'whereClauses' => 
							array('first_name' => 'prospects.first_name',
									'last_name' => 'prospects.last_name'),
						'searchInputs' =>
							array('first_name', 'last_name'),
						'selectDoms' =>
							array('LIST_OPTIONS' => 
											array('dom' => 'prospect_list_type_dom', 'searchInput' => 'list_type'),
								  ),
						'create' =>
							array('formBase' => 'ProspectFormBase.php',
									'formBaseClass' => 'ProspectFormBase',
									'getFormBodyParams' => array('','','ProspectSave'),
									'createButton' => 'LNK_NEW_PROSPECT'
								  )
						);


?>
 
 