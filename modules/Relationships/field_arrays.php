<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Relationship'] = array ('column_fields' => Array(
		'id',
		'relationship_name',
		'lhs_module',
		'lhs_table',
		'lhs_key',
		'rhs_module',
		'rhs_table',
		'rhs_key',
		'join_table',
		'join_key_lhs',
		'join_key_rhs',
		'relationship_type',
		'relationship_role_column',
		'relationship_role_column_value',
		'reverse',
	),
        'list_fields' =>  Array(
		'id',
		'relationship_name',
		'lhs_module',
		'lhs_table',
		'lhs_key',
		'rhs_module',
		'rhs_table',
		'rhs_key',
		'join_table',
		'join_key_lhs',
		'join_key_rhs',
		'relationship_type',
		'relationship_role_column',
		'relationship_role_column_value',
		'reverse',
	),
    'required_fields' =>   array("relationship_name"=>1),
);
?>