<?php



$listViewDefs['Teams'] = array(
    'NAME' => array(
        'width' => '20', 
        'label' => 'LBL_NAME', 
        'link' => true,
        'default' => true,
		'related_fields' => array('name_2',),),
    'DESCRIPTION' => array(
        'width' => '80', 
        'label' => 'LBL_DESCRIPTION', 
        'default' => true),       
);
