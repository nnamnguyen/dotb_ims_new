<?php

 
$layout_defs['EmailMarketing'] = array( 
	// list of what Subpanels to show in the DetailView 
	'subpanel_setup' => array(
        'prospectlists' => array(
			'order' => 10,
			'sort_order' => 'asc',
			'sort_by' => 'name',
			'module' => 'ProspectLists',
			'get_subpanel_data'=>'prospectlists',
			'set_subpanel_data'=>'prospectlists',			
			'subpanel_name' => 'default',
			'title_key' => 'LBL_PROSPECT_LIST_SUBPANEL_TITLE',
			'top_buttons' => array(),
		),
        'allprospectlists' => array(
			'order' => 20,
			'module' => 'ProspectLists',
			'sort_order' => 'asc',
			'sort_by' => 'name',
			'get_subpanel_data'=>'function:get_all_prospect_lists',
			'set_subpanel_data'=>'prospectlists',			
			'subpanel_name' => 'default',
			'title_key' => 'LBL_PROSPECT_LIST_SUBPANEL_TITLE',
			'top_buttons' => array(),
		),
	)
);
?>