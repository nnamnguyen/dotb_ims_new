<?php


$subpanel_layout = array(
	'where'				=> "",


	'fill_in_additional_fields'	=> true,
	'list_fields' => array(
		'object_image'=>array(
			'widget_class'			=> 'SubPanelIcon',
 		 	'width'					=> '2%',
		),
		'name' => array(
			 'vname'				=> 'LBL_LIST_SUBJECT',
			 'widget_class'			=> 'SubPanelDetailViewLink',
			 'width'				=> '30%',
             'parent_info'          => true
		),
		'status' => array(
			 'vname'				=> 'LBL_LIST_STATUS',
			 'width'				=> '15%',
		),
		'reply_to_status' => array(
			 'usage'				=> 'query_only',
             'force_exists'			=> true,
			 'force_default'		=> 0,
		),
		'contact_name'=>array(
             'widget_class'         => 'SubPanelDetailViewLink',
             'target_record_key'    => 'contact_id',
             'target_module'        => 'Contacts',
             'module'               => 'Contacts',
             'vname'                => 'LBL_LIST_CONTACT',
             'width'                => '11%',
             'sortable'             => false,
             'force_exists'			=> true,
        ),
        'contact_id'=>array(
            'usage'=>'query_only',
    		'force_exists'=>true
        ),
        'contact_name_owner'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
        'contact_name_mod'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
		'parent_id'=>array(
            'usage'=>'query_only',
			'force_exists'=>true
        ),
		'parent_type'=>array(
            'usage'=>'query_only',
			'force_exists'=>true
        ),
		'date_modified' => array(
			'width'					=> '10%',
		),
		'date_entered'=>array(
			'vname' => 'LBL_LIST_DATE_ENTERED',
			'width' => '10%',
		),
		'assigned_user_name' => array (
			'name' => 'assigned_user_name',
			'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'target_record_key' => 'assigned_user_id',
			'target_module' => 'Employees',
			'width' => '10%',			
		),
		'edit_button' => array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class'			=> 'SubPanelEditButton',
			 'width'				=> '2%',
		),
		'remove_button' => array(
			'vname' => 'LBL_REMOVE',
			 'widget_class'			=> 'SubPanelRemoveButton',
			 'width'				=> '2%',
		),
		'filename' => array(
			'usage'					=> 'query_only',
			'force_exists'			=> true
		),
	), // end list_fields
);
?>
