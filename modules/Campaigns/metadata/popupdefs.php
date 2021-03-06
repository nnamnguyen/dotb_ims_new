<?php


$popupMeta = array(
	'moduleMain' => 'Campaign',
	'varName' => 'CAMPAIGN',
	'orderBy' => 'name',
	'whereClauses' => 
		array('name' => 'campaigns.name'),
	'searchInputs' =>
		array('name'),
	'listviewdefs' => array(
		'NAME' => array(
			'width' => '20', 
			'label' => 'LBL_LIST_CAMPAIGN_NAME',
	        'link' => true,
	        'default' => true), 
		 'CAMPAIGN_TYPE' => array(
	        'width' => '10', 
	        'label' => 'LBL_LIST_TYPE',
	        'default' => true),
		'STATUS' => array(
			'width' => '10', 
			'label' => 'LBL_LIST_STATUS',
	        'default' => true),
		'START_DATE' => array(
	        'width' => '10', 
	        'label' => 'LBL_LIST_START_DATE',
	        'default' => true),
		'END_DATE' => array(
	        'width' => '10', 
	        'label' => 'LBL_LIST_END_DATE',
	        'default' => true), 
	),
	'searchdefs'   => array(
	 	'name', 
		'campaign_type', 
		'status',
		'start_date',
		'end_date'
	)
);
?>
