<?php


  $searchdefs['Project'] = array(
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
							'estimated_start_date',
							'estimated_end_date',
							'status',
							'priority',		
							

		      array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
						),
					),
 			   );
?>
