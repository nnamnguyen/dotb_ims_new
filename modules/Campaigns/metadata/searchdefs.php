<?php


$searchdefs['Campaigns'] = array(
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
				 	array('name'=>'start_date', 'type'=>'date', 'displayParams'=>array('showFormats'=>true)),
					array('name'=>'end_date', 'type'=>'date', 'displayParams'=>array('showFormats'=>true)),
					'status',
					'campaign_type',
					array('name' => 'assigned_user_id', 'label'=>'LBL_ASSIGNED_TO', 'type' => 'enum', 'function' => array('name' => 'get_user_array', 'params' => array(false))),
					

		      array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
				),												
			),
);
?>
