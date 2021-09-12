<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Project'] = array ('column_fields' => array(
        'id',
        'date_entered',
        'date_modified',
        'assigned_user_id',
        'modified_user_id',
        'created_by',
        'team_id',
        'name',
        'description',
        'deleted',
        'priority',
        'status',
        'estimated_start_date',
        'estimated_end_date',
        
    ),
        'list_fields' =>  array(
        'id',
        'assigned_user_id',
        'assigned_user_name',
        'team_id',
        'team_name',
        'name',
        'relation_id',
        'relation_name',
        'relation_type',
        'total_estimated_effort',
        'total_actual_effort',
        'status',
        'priority',     
        
    ),
    'required_fields' =>  array('name'=>1, 'estimated_start_date'=>2, 'estimated_end_date'=>3),
);
?>