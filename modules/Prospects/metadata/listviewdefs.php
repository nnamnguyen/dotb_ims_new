<?php



$listViewDefs['Prospects'] = array(
	'FULL_NAME' => array(
		'width' => '20', 
		'label' => 'LBL_LIST_NAME', 
		'link' => true,
        'related_fields' => array('first_name', 'last_name'),
        'orderBy' => 'last_name',
        'default' => true),
    'TITLE' => array(
        'width' => '20', 
        'label' => 'LBL_LIST_TITLE', 
        'link' => false,
        'default' => true),   
    'EMAIL1' => array(
        'width' => '20', 
        'label' => 'LBL_LIST_EMAIL_ADDRESS',
        'sortable' => false, 
        'link' => false,
        'default' => true),           
    'PHONE_WORK' => array(
        'width' => '10', 
        'label' => 'LBL_LIST_PHONE', 
        'link' => false,
        'default' => true), 
	'DATE_ENTERED' => array (
	    'type' => 'datetime',
	    'label' => 'LBL_DATE_ENTERED',
	    'width' => '10',
	    'default' => true,
	  ),  
);
?>
