<?php

 
$layout_defs['ContractTypes'] = array( 
	// list of what Subpanels to show in the DetailView 
	'subpanel_setup' => array(
		'contract_documents' => array(
			'order' => 10,
			'module' => 'Documents',
			'sort_by' => 'document_name',
			'sort_order' => 'asc',			
			'subpanel_name' => 'ForContractType',
			'get_subpanel_data' => 'documents',
			'set_subpanel_data' => 'documents',
			'title_key' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
			'fill_in_additional_fields' => true,
			'refresh_page' => 1,			
			'top_buttons' => array(
	   			array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Documents')
			),
		),
	),
);	
?>