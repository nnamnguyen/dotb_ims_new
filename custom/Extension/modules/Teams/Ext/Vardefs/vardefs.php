<?php
//Custom field - By Lap Nguyen
$dictionary['Team']['fields']['short_name'] = array(
    'required' => true,
    'name' => 'short_name',
    'vname' => 'LBL_SHORT_NAME',
    'type' => 'name',
    'dbType' => 'varchar',
    'source' => 'db',
    'len' => '30',
);

$dictionary['Team']['fields']['code_prefix'] = array(
    'required' => true,
    'name' => 'code_prefix',
    'vname' => 'LBL_PREFIX',
    'type' => 'name',
    'dbType' => 'varchar',
    'source' => 'db',
    'len' => '30',
);
$dictionary['Team']['fields']['phone_number'] = array(
    'required' => false,
    'name' => 'phone_number',
    'vname' => 'LBL_PHONE_NUMBER',
    'type' => 'varchar',
    'massupdate' => 0,
    'audited' => false,
    'len' => '50',
    'source' => 'db',
    'size' => '20',
);
$dictionary['Team']['fields']['region'] = array(
    'name' => 'region',
    'required' => true,
    'vname' => 'LBL_REGION',
    'type' => 'enum',
    'importable' => 'true',
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'region_list',
    'source' => 'db',
    'studio' => 'visible',
);

$dictionary['Team']['fields']['country'] = array(
    'name' => 'country',
    'required' => true,
    'vname' => 'LBL_COUNTRY',
    'type' => 'enum',
    'importable' => 'true',
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'source' => 'db',
    'options' => 'region_list',
    'studio' => 'visible',
);
$dictionary['Team']['fields']['manager_user_id'] = array(
    'name' => 'manager_user_id',
    'vname' => 'LBL_MANAGER_USER_ID',
    'type' => 'id',
    'source' => 'db',
);

$dictionary['Team']['fields']['manager_user_id'] = array(
    'required' => false,
    'name' => 'manager_user_id',
    'vname' => 'LBL_MANAGER_USER',
    'type' => 'id',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'reportable' => false,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'calculated' => false,
    'len' => 36,
    'size' => '20',
    'dbType' => 'id',
    'studio' => 'visible',
);
$dictionary['Team']['fields']['manager_user_name'] = array(
    'name' => 'manager_user_name',
    'rname' => 'manager_user_name',
    'id_name' => 'manager_user_id',
    'vname' => 'LBL_MANAGER_USER',
    'type' => 'relate',
    'link' => 'manager_user_link',
    'table' => 'users',
    'isnull' => 'true',
    'module' => 'Users',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable'=>true,
    'source' => 'non-db',
);
$dictionary['Team']['fields']['manager_user_link'] = array(
    'name' => 'manager_user_link',
    'type' => 'link',
    'relationship' => 'manager_user_rel',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_MANAGER_USER',
);
//Parent Team - Right Side (n) - By Lap Nguyen
$dictionary['Team']['fields']['parent_id'] = array(
    'name' => 'parent_id',
    'vname' => 'LBL_PARENT_ID',
    'type' => 'id',
    'required'=>false,
    'reportable'=>false,
    'source' => 'db',
    'comment' => 'The country this Team belong to'
);
$dictionary['Team']['fields']['parent_name'] = array(
    'name' => 'parent_name',
    'rname' => 'name',
    'id_name' => 'parent_id',
    'vname' => 'LBL_PARENT',
    'type' => 'relate',
    'link' => 'parent_teams',
    'table' => 'teams',
    'isnull' => 'true',
    'module' => 'Teams',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable'=>true,
    'source' => 'non-db',
);
$dictionary['Team']['fields']['parent_teams'] = array(
    'name' => 'parent_teams',
    'type' => 'link',
    'relationship' => 'team_teams',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_PARENT',
);
//END: Parent Team

//Customize Relationship
$dictionary['Team']['fields']['child_teams'] = array(
    'name' => 'child_teams',
    'type' => 'link',
    'relationship' => 'team_teams',
    'source' => 'non-db',
    'vname' => 'LBL_CHILD',
);
$dictionary['Team']['relationships']['team_teams'] = array(
    'lhs_module' => 'Teams',
    'lhs_table' => 'teams',
    'lhs_key' => 'id',
    'rhs_module' => 'Teams',
    'rhs_table' => 'teams',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many'
);

/**
* Added by Hieu Pham
* To save sms config
*/
$dictionary['Team']['fields']['sms_config'] = array(
    'required' => true,
    'name' => 'sms_config',
    'vname' => 'LBL_SMS_CONFIG',
    'type' => 'text',
    'audited' => true,
    'size' => '20',
);
