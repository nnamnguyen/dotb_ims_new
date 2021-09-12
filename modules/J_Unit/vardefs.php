<?php



$dictionary['J_Unit'] = array(
    'table' => 'j_unit',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array (
        'quantity' => array(
            'name' => 'quantity',
            'vname' => 'LBL_QUANTITY',
            'type' => 'decimal',
            'len' => '12',
            'precision' => '2',
            'validation' => array('type' => 'range', 'greaterthan' => -1),
            'comment' => 'Quantity in use',
            'default' => 1.0
        ),
        'base_unit_id' =>
            array(
                'name' => 'base_unit_id',
                'vname' => 'LBL_BASE_UNIT_ID',
                'type' => 'id',
                'required'=>true,
                'reportable'=>false,
                'comment' => '',
                'default' => ''
            ),
        'base_unit_name' =>
            array(
                'name' => 'base_unit_name',
                'rname' => 'name',
                'id_name' => 'base_unit_id',
                'vname' => 'LBL_BASE_UNIT_NAME',
                'type' => 'relate',
                'link' => 'base_unit_link',
                'table' => 'j_unit',
                'isnull' => 'true',
                'module' => 'J_Unit',
                'dbType' => 'varchar',
                'len' => 'id',
                'reportable'=>true,
                'source' => 'non-db',
                'auto_populate' => true,
            ),
        'base_unit_link' =>
            array(
                'name' => 'base_unit_link',
                'type' => 'link',
                'relationship' => 'unit_base_unit',
                'link_type' => 'one',
                'side' => 'right',
                'source' => 'non-db',
                'vname' => 'LBL_BASE_UNIT_NAME',
                'id_name' => 'base_unit_id',
            ),
        'quantity_base_unit' => array(
            'name' => 'quantity_base_unit',
            'vname' => 'LBL_QUANTITY_BASE_UNIT',
            'type' => 'decimal',
            'len' => '12',
            'precision' => '2',
            'validation' => array('type' => 'range', 'greaterthan' => -1),
            'comment' => 'Quantity in use',
            'default' => 1.0
        ),
        'is_primary'
        => array(
            'name' => 'is_primary',
            'vname' => 'LBL_IS_PRIMATY',
            'type' => 'bool',
            'massupdate' => false,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => true,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'pii' => false,
            'default' => false,
            'calculated' => false,
            'dependency' => false,
        ),
        'group_unit_id' =>
            array(
                'name' => 'group_unit_id',
                'vname' => 'LBL_GROUP_UNIT_ID',
                'type' => 'id',
                'required'=>true,
                'reportable'=>false,
                'comment' => ''
            ),
        'group_unit_name' =>
            array(
                'name' => 'group_unit_name',
                'rname' => 'name',
                'id_name' => 'group_unit_id',
                'vname' => 'LBL_GROUP_UNIT_NAME',
                'type' => 'relate',
                'link' => 'group_unit_link',
                'table' => 'j_groupunit',
                'isnull' => 'true',
                'module' => 'J_GroupUnit',
                'dbType' => 'varchar',
                'len' => 'id',
                'reportable'=>true,
                'source' => 'non-db',
                'auto_populate' => true,
            ),
        'group_unit_link' =>
            array(
                'name' => 'group_unit_link',
                'type' => 'link',
                'relationship' => 'unit_in_group',
                'link_type' => 'one',
                'side' => 'right',
                'source' => 'non-db',
                'vname' => 'LBL_GROUP_UNIT_NAME',
                'id_name' => 'group_unit_id',
            ),
),
    'relationships' => array (

),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('J_Unit','J_Unit', array('basic','team_security','assignable','taggable'));