<?php

$searchFields['Reports'] =
	array (
		'name' => array( 'query_type' => 'default'),
        'report_module' => array('query_type' => 'default', 'db_field' => array('module')),
        'assigned_user_id'=> array('query_type' => 'default'),
        'report_type' => array('query_type' => 'default', 'options' => 'dom_report_types'),
        'team_id'=> array(
			'query_type' => 'format',
			'operator' => 'subquery',
			'subquery' => "SELECT team_set_id FROM team_sets_teams WHERE team_id IN ({0})",
			'db_field' => array(
				'team_set_id',
			)
		),
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites
			                    WHERE dotbfavorites.deleted=0
			                        and dotbfavorites.module = \'Reports\'
			                        and dotbfavorites.assigned_user_id = \'{0}\'',
			'db_field'=>array('id')),
	);
?>
