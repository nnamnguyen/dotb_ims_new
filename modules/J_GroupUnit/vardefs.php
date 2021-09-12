<?php



$dictionary['J_GroupUnit'] = array(
    'table' => 'j_groupunit',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array (
        'primary_unit' => array(
            'name' => 'primary_unit',
            'vname' => 'LBL_PRIMARY_UNIT',
            'label' => 'LBL_PRIMARY_UNIT',
            'type' => 'varchar',
            'len' => '100',
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
VardefManager::createVardef('J_GroupUnit','J_GroupUnit', array('basic','team_security','assignable','taggable'));