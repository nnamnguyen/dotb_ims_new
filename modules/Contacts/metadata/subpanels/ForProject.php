<?php


$subpanel_layout = array(
	'top_buttons' => array(
				array('widget_class' => 'SubPanelTopSelectButton', 'title' => 'LBL_SELECT_USER_RESOURCE', 'popup_module' => 'Users', ),
	),

	'where' => '',

	'list_fields' => array(
		'object_image'=>array(
			'widget_class' => 'SubPanelIcon',
 		 	'width' => '2%',
		),
		'name'=>array(
			'name' => 'name',
		 	'vname' => 'LBL_RESOURCE_NAME',
			'width' => '93%',
		),		
/*		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			 'widget_class' => 'SubPanelRemoveButtonProjects',
			 'width' => '5%',
		),
		*/
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Contacts',
			'width' => '5%',
		),		
	    'first_name' => array(
		    'usage'=>'query_only',
		),
		'last_name' => array(
		    'usage'=>'query_only',
        ),
		'salutation'=>array(
			'name'=>'salutation',
		 	'usage' => 'query_only',
		),
	),
);
?>