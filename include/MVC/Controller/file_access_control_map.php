<?php
$file_access_control_map = array(
	'modules' => array(
		'administration' => array(
			'actions' => array(
				'backups',
				'updater',
			),
			'links'	=> array(
				'update',
				'backup_management',
				'upgrade_wizard',
				'moduleBuilder',
			),
		),
		'upgradewizard' => array(
				'actions' => array(
					'index',
				),
		),
		'modulebuilder' => array(
				'actions' => array(
					'index' => array('params' => array('type' => array('mb'))),
				),
		),
	)
);
?>