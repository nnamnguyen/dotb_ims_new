<?php



$dictionary['project_task_project_tasks'] = array(
	'table' => 'project_task_project_tasks',
	'fields' => array(
		'id' => array(
			'name' => 'id',
			'vname' => 'LBL_ID',
			'required' => true,
			'type' => 'id',
		),
		'project_task_id' => array(
			'name' => 'project_task_id',
			'vname' => 'LBL_PROJECT_TASK_ID',
			'required' => true,
			'type' => 'id',
		),
        'predecessor_project_task_id' => array(
            'name' => 'predecessor_project_task_id',
            'vname' => 'LBL_PROJECT_TASK_ID',
            'required' => true,
            'type' => 'id',
        ),        
		'deleted' => array(
			'name' => 'deleted',
			'vname' => 'LBL_DELETED',
			'type' => 'bool',
			'required' => false,
			'default' => '0',
		),
	),
	'indices' => array(
		array(
			'name' =>'proj_rel_pk',
			'type' =>'primary',
			'fields'=>array('id')
		),
	),

    'relationships' => array(
        'project_task_project_tasks' => array(
            'lhs_module'        => 'ProjectTasks2', 
            'lhs_table'         => 'project_tasks', 
            'lhs_key'           => 'id',
            'rhs_module'        => 'ProjectTasks2', 
            'rhs_table'         => 'project_tasks', 
            'rhs_key'           => 'id',
            'relationship_type' => 'many-to-many',
            'join_table'        => 'project_task_project_tasks', 
            'join_key_lhs'      => 'project_task_id', 
            'join_key_rhs'      => 'predecessor_project_task_id',
        ),
    ),
);

?>
