<?php

$searchFields['ProspectLists'] = 
    array (
        'name' => array( 'query_type'=>'default'),
        'list_type' => array( 'query_type'=>'default'),
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites
			                    WHERE dotbfavorites.deleted=0
			                        and dotbfavorites.module = \'ProspectLists\'
			                        and dotbfavorites.assigned_user_id = \'{0}\'',
			'db_field'=>array('id')),
    );
?>
