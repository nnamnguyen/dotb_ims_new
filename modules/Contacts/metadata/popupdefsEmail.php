<?php


global $mod_strings;

$popupMeta = array('moduleMain' => 'Contact',
						'varName' => 'CONTACT',
						'orderBy' => 'contacts.first_name, contacts.last_name',
						'whereClauses' => 
							array('first_name' => 'contacts.first_name', 
									'last_name' => 'contacts.last_name',
									'account_name' => 'accounts.name',
									'account_id' => 'accounts.id'),
						'searchInputs' =>
							array('first_name', 'last_name', 'account_name'),
						'create' =>
							array('formBase' => 'ContactFormBase.php',
									'formBaseClass' => 'ContactFormBase',
									'getFormBodyParams' => array('','','ContactSave'),
									'createButton' => 'LNK_NEW_CONTACT'
								  ),
						'templateForm' => 'modules/Contacts/Email_picker.html',
						);
?>
