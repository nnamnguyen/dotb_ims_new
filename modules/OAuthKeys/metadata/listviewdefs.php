<?php




$module_name = 'OAuthKeys';
$listViewDefs[$module_name] = array(
	'NAME' => array(
		'width' => '32',
		'label' => 'LBL_NAME',
		'default' => true,
        'link' => true,
    ),
	'C_KEY' => array(
		'width' => '40',
		'label' => 'LBL_CONSKEY',
        'default' => true),
    'OAUTH_TYPE' => array(
        'width' => '20',
        'label' => 'LBL_OAUTH_TYPE',
        'default' => true,
    ),
    'CLIENT_TYPE' => array(
        'width' => '20',
        'label' => 'LBL_CLIENT_TYPE',
        'default' => true,
    ),
);
