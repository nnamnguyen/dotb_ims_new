<?php

 

$layout_defs['Teams'] = array(
	// list of what Subpanels to show in the DetailView 
	'subpanel_setup' => array(
        'users' => array(
        'top_buttons' => array(
			array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Users', 'mode'=>'MultiSelect'),
		),
		'fill_in_additional_fields'=>true,
	
			'order' => 10,
			'module' => 'Users',
			'sort_by' => 'user_name',
			'sort_order' => 'asc',
			'subpanel_name' => 'ForTeams',
			'get_subpanel_data' => 'users',
			'add_subpanel_data' => 'user_id',
			'title_key' => 'LBL_USERS_SUBPANEL_TITLE',
		),
	),
);
?>