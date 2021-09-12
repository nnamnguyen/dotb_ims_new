<?php



$listViewDefs['EmailTemplates'] = array(
	'NAME' => array(
		'width' => '20', 
		'label' => 'LBL_NAME', 
		'link' => true,
        'default' => true),
    'TYPE' => array(
        'width' => '20',
        'label' => 'LBL_TYPE',
        'link' => false,
        'default' => true),
    'DESCRIPTION' => array(
        'width' => '40', 
        'default' => true,
        'sortable' => false,
        'label' => 'LBL_DESCRIPTION'),
    'ASSIGNED_USER_NAME' => array (
        'width' => '10',
        'label' => 'LBL_LIST_ASSIGNED_USER',
        'module' => 'Employees',
        'id' => 'ASSIGNED_USER_ID',
        'default' => true,),
    'DATE_MODIFIED' => array(
        'width' => '10', 
        'default' => true,
        'label' => 'LBL_DATE_MODIFIED'),
	'DATE_ENTERED' => array (
	    'width' => '10',
	    'label' => 'LBL_DATE_ENTERED',
	    'default' => true),
);
?>
