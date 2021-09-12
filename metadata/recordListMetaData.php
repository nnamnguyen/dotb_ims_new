<?php


$dictionary['RecordList'] = array(
    'table' => 'record_list',
	'fields' => array(
		'id' => array(
			'name'	=> 'id',
			'type'	=> 'id',
			'required'	=> true,
			'reportable' => false,
		),
		'assigned_user_id' => array(
			'name' => 'assigned_user_id',
			'vname' => 'LBL_USER_ID',
			'type' => 'id',
			'required' => true,
			'reportable' => false,
		),
		'module_name' => array(
			'name' => 'module_name',
			'vname' => 'LBL_MODULE',
			'type' => 'varchar',
			'len' => '50',
			'required' => true,
			'reportable' => false,
		),
		'records' => array(
			'name' => 'records',
			'vname' => 'LBL_RECORD_LIST',
            'type' => 'longtext',
			'required' => true,
			'reportable' => false,
		),
        'date_modified' => array(
            'name' => 'date_modified',
            'vname' => 'LBL_DATE_MODIFIED',
            'type' => 'datetime',
        ),
	),
	'indices' => array(
		array(
            'name' => 'record_list_id',
			'type' => 'primary',
			'fields' => array(
				'id',
            )
        ),
	), /* end indices */
);
