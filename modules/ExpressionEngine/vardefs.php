<?php


$dictionary['Formula'] = array(
    'table' => 'formulas',
    'comment' => 'Stored formulas that can be re-used ansd referenced in DotbLogic',
    'fields' => array(
        'target_module' => array(
            'name' => 'target_module',
            'vname' => 'LBL_TARGET_MODULE',
            'type' => 'varchar',
            'len' => '255',
            'comment' => 'The target module for this formula',
            'required' => true,
        ),
        'formula' => array(
            'name' => 'formula',
            'vname' => 'LBL_FORMULA',
            'type' => 'varchar',
            'len' => '255',
            'required' => true,
        ),
        'return_type' => array(
            'name' => 'return_type',
            'vname' => 'LBL_RETURN_TYPE',
            'type' => 'varchar',
            'len' => '255',
            'required' => true,
        ),
    ),
);

VardefManager::createVardef('ExpressionEngine','Formula', array('default', 'basic'));
