<?php



$dictionary['C_AdminConfig'] = array(
    'table' => 'c_adminconfig',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array (
),
    'relationships' => array (
),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('C_AdminConfig','C_AdminConfig', array('basic','assignable','taggable'));