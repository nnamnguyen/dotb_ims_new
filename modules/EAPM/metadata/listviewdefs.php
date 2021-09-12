<?php




$module_name = 'EAPM';
$listViewDefs[$module_name] = array(
	'NAME' => array(
		'width' => '32',
		'label' => 'LBL_NAME',
		'default' => true,
        'link' => true,
    ),
	'APPLICATION' => array(
		'width' => '40',
		'label' => 'LBL_APPLICATION',
        'default' => true),
	'ACTIVE' => array(
		'width' => '10',
		'label' => 'LBL_ACTIVE',
        'default' => true),
	'VALIDATED' => array(
		'width' => '10',
		'label' => 'LBL_VALIDATED',
        'default' => true),
	'ASSIGNED_USER_NAME' => array(
		'width' => '9',
		'label' => 'LBL_ASSIGNED_TO_NAME',
		'module' => 'Employees',
        'id' => 'ASSIGNED_USER_ID',
        'default' => true),

);
?>
