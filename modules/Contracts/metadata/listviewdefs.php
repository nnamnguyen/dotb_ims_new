<?php



$listViewDefs['Contracts'] = array(
    'NAME' => array(
        'width' => '40', 
        'label' => 'LBL_LIST_CONTRACT_NAME', 
        'link' => true,
        'default' => true),
    'ACCOUNT_NAME' => array(
        'width' => '20', 
        'label' => 'LBL_LIST_ACCOUNT_NAME', 
        'module' => 'Accounts',
        'id' => 'ACCOUNT_ID',
        'link' => true,
        'default' => true,
        'ACLTag' => 'ACCOUNT',
        'related_fields' => array('account_id')),        
    'STATUS' => array(
        'width' => '10', 
        'label' => 'LBL_STATUS', 
        'link' => false,
        'default' => true),               
    'START_DATE' => array(
        'width' => '15', 
        'label' => 'LBL_LIST_START_DATE', 
        'link' => false,
        'default' => true),
    'END_DATE' => array(
        'width' => '15', 
        'label' => 'LBL_LIST_END_DATE', 
        'link' => false,
        'default' => true),    
    'TEAM_NAME' => array(
        'width' => '2', 
        'label' => 'LBL_LIST_TEAM',
        'default' => false,
        'related_fields' => array('team_id')),
    
    'ASSIGNED_USER_NAME' => array(
        'width' => '2', 
        'label' => 'LBL_LIST_ASSIGNED_TO_USER',
        'module' => 'Employees',
        'id' => 'ASSIGNED_USER_ID',
        'default' => true),
        
);
?>
