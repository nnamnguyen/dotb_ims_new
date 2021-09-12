<?php

$fields_array['Case'] = array ('column_fields' => Array("id"
        , "name"
        , "case_number"
        , "account_name"
        , "account_id"
        , "date_entered"
        , "date_modified"
        , "modified_user_id"
        , "assigned_user_id"
        , "created_by"
        ,"team_id"
        , "status"
        , "priority"
        , "description"
        , "resolution"
        ),
        'list_fields' => Array('id', 'priority', 'status', 'name', 'account_name', 'case_number', 'account_id', 'assigned_user_name', 'assigned_user_id'
    , "team_id"
    , "team_name"
        ),
        'required_fields' => array('name'=>1, 'account_name'=>2),
);
?>
