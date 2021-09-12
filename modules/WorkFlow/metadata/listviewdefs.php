<?php



$listViewDefs['WorkFlow'] = array(
    'NAME' => array(
        'width' => '30', 
        'label' => 'LBL_LIST_NAME', 
        'link' => true,
        'default' => true),
    'TYPE' => array(
        'width' => '30', 
        'label' => 'LBL_LIST_TYPE', 
        'default' => true),
    'STATUS' => array(
        'width' => '20', 
        'label' => 'LBL_LIST_STATUS', 
        'customCode' => '{$STATUS}',
        'default' => true),
    'BASE_MODULE' => array(
        'width' => '20', 
        'label' => 'LBL_LIST_BASE_MODULE', 
        'default' => true),
);
