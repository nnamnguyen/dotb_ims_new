<?php



$listViewDefs['SavedSearch'] = array(
	'NAME' => array(
        'width' => '40',
		'label' => 'LBL_LIST_NAME',
		'link' => true,
		'customCode' => '<a  href="index.php?action=index&module=SavedSearch&saved_search_select={$ID}">{$NAME}</a>'),
	'SEARCH_MODULE' => array(
        'width' => '35',
		'label' => 'LBL_LIST_MODULE'), 
	'TEAM_NAME' => array(
        'width' => '15',
		'label' => 'LBL_LIST_TEAM',
		'default' => false),
	'ASSIGNED_USER_NAME' => array(
        'width' => '10',
		'label' => 'LBL_LIST_ASSIGNED_USER')
);
