<?php

  $searchdefs['Reports'] = array(
					'templateMeta' => array(
							'maxColumns' => '3',
                            'maxColumnsBasic' => '4',
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
						'basic_search' => array(
						 	'name',
                            array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),

		      array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
							),
						'advanced_search' => array(
							'name',
							array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),
							'favorite',
							'report_module',
							'report_type',
							'assigned_user_name',
							'team_name',

		      array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
						),
					),
 			   );
?>
