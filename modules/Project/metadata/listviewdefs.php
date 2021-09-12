<?php



$listViewDefs['Project'] = array(
	'NAME' => array(
		'width' => '40',  
		'label' => 'LBL_LIST_NAME', 
		'link' => true,
        'default' => true),
    'ESTIMATED_START_DATE' => array(
        'width' => '20',  
        'label' => 'LBL_DATE_START', 
        'link' => false,
        'default' => true),    
    'ESTIMATED_END_DATE' => array(
        'width' => '20',  
        'label' => 'LBL_DATE_END', 
        'link' => false,
        'default' => true), 
    'STATUS' => array(
        'width' => '20',  
        'label' => 'LBL_STATUS', 
        'link' => false,
        'default' => true),         
	'ASSIGNED_USER_NAME' => array(
		'width' => '10', 
		'label' => 'LBL_LIST_ASSIGNED_USER_ID',
		'module' => 'Employees',
        'id' => 'ASSIGNED_USER_ID',
        'default' => true),
    'TEAM_NAME' => array(
        'width' => '2', 
        'label' => 'LBL_LIST_TEAM',
        'related_fields' => array('team_id'),        
        'default' => false),

);

?>
