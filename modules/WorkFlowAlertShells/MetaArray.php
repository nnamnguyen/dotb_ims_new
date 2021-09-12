<?php


$process_dictionary['AlertShellDetailView'] = Array('elements'=> array(

'Email' => array(
'module_title' => 'LBL_MODULE_TITLE',
'sub_panel_title' => 'LBL_MODULE_NAME',
'statement_title' => 'LBL_LIST_STATEMENT',
'include_components' => array(	'current_user',
								'rel_user',
								'rel_user_custom',
								'trig_user_custom',
								'specific_user',
								'specific_team',
								'specific_role',
								'login_user',
								),
				//End element E-mail
				),
				
'Invite' => array(
				'module_title' => 'LBL_MODULE_TITLE_INVITE',
				'sub_panel_title' => 'LBL_MODULE_NAME_INVITE',
				'statement_title' => 'LBL_LIST_STATEMENT_INVITE',
				'include_components' => array(	'current_user',
								'rel_user',
								'rel_user_custom',
								'trig_user_custom',
								'specific_user',
								'specific_team',
								'specific_role',
								'login_user',
								),
				//End element Invite
				),
	
	//end elements array			
	),
);


?>