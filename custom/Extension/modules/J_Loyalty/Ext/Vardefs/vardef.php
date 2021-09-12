<?php
//$dictionary['J_Loyalty']['fields']['meeting_id'] = array(
//    'name'              => 'meeting_id',
//    'rname'             => 'id',
//    'vname'             => 'LBL_METTING_NAME',
//    'type'              => 'id',
//    'table'             => 'meetings',
//    'isnull'            => 'true',
//    'module'            => 'Meetings',
//    'dbType'            => 'id',
//    'reportable'        => false,
//    'massupdate'        => false,
//    'duplicate_merge'   => 'disabled',
//);
//
//$dictionary['J_Loyalty']['fields']['meeting_name'] = array(
//    'required'  => false,
//    'source'    => 'non-db',
//    'name'      => 'meeting_name',
//    'vname'     => 'LBL_MEETING_NAME',
//    'type'      => 'relate',
//    'rname'     => 'name',
//    'id_name'   => 'meeting_id',
//    'join_name' => 'meetings',
//    'link'      => 'meetings_loyalty_link',
//    'table'     => 'meetings',
//    'isnull'    => 'true',
//    'module'    => 'Meetings',
//);
//
//$dictionary['J_Loyalty']['fields']['meetings_loyalty_link'] = array(
//    'name'          => 'meetings_loyalty_link',
//    'type'          => 'link',
//    'relationship'  => 'meetings_loyalty_link',
//    'module'        => 'Meetings',
//    'bean_name'     => 'Meetings',
//    'source'        => 'non-db',
//    'vname'         => 'LBL_MEETING_NAME',
//);

$dictionary['J_Loyalty']['fields']['parent_type'] =array(
    'name' => 'parent_type',
    'vname' => 'LBL_PARENT_TYPE',
    'type' => 'parent_type',
    'dbType' => 'varchar',
    'required' => false,
    'group' => 'parent_name',
    'options' => 'parent_type_display_custom',
    'len' => 255,
    'studio' => array('wirelesslistview' => false),
    'comment' => 'The Dotb object to which the call is related',
    'default' => 'Accounts'
);
$dictionary['J_Loyalty']['fields']['parent_id'] =array(
    'name' => 'parent_id',
    'vname' => 'LBL_LIST_RELATED_TO_ID',
    'type' => 'id',
    'group' => 'parent_name',
    'reportable' => false,
    'comment' => 'The ID of the parent Dotb object identified by parent_type',
    'required' => true
);

$dictionary['J_Loyalty']['fields']['parent_name'] =array(
    'name' => 'parent_name',
    'parent_type' => 'record_type_display',
    'type_name' => 'parent_type',
    'id_name' => 'parent_id',
    'vname' => 'LBL_LIST_RELATED_TO',
    'type' => 'parent',
    'group' => 'parent_name',
    'source' => 'non-db',
    'options' => 'parent_type_display_custom',
    'studio' => true,
    'required' => true,
    'auto_populate' => true,
);