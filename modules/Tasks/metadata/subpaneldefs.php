<?php


 


$layout_defs['Tasks'] = array(
	// sets up which panels to show, in which order, and with what linked_fields
	'subpanel_setup' => array(
		'history' => array(
			'order' => 40,
			'title_key' => 'LBL_HISTORY_SUBPANEL_TITLE',
			'type' => 'collection',
			'subpanel_name' => 'history',   //this values is not associated with a physical file.
			'sort_order' => 'desc',
			'sort_by' => 'date_entered',
			'header_definition_from_subpanel'=> 'calls',
			'module'=>'History',
			'top_buttons' => array(
				array('widget_class' => 'SubPanelTopCreateNoteButton'),
			),	
			'collection_list' => array(		
				'notes' => array(
					'module' => 'Notes',
					'subpanel_name' => 'ForTasks',
					'get_subpanel_data' => 'notes',
				),		
			),
		), /* end history subpanel def */
	),
);
?>
