<?php

  $searchdefs['ProspectLists'] = array(
					'templateMeta' => array(
							'maxColumns' => '3',
                            'maxColumnsBasic' => '4',
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
						'basic_search' => array(
						    array('name'=>'name', 'label'=>'LBL_PROSPECT_LIST_NAME',),
						 	array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),


		      array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
						),
						'advanced_search' => array(
						    array('name'=>'name', 'label'=>'LBL_PROSPECT_LIST_NAME',),
						 	array('name'=>'list_type', 'label'=>'LBL_LIST_TYPE', 'type'=>'enum'),
						 	array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),


		      array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
						),
					),
 			   );
?>
