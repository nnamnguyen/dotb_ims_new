<?php

$dictionary['CJ_Form'] = array (
    'table' => 'cj_forms',
    'audited' => true,
    'unified_search' => false,
    'duplicate_merge' => true,
    'activity_enabled' => false,
    'comment' => 'CJ_Form',
    'fields' => array (),
    'relationships' => array (),
    'optimistic_lock' => true,
);

VardefManager::createVardef('CJ_Forms', 'CJ_Form', array (
    'basic',
    'team_security',
));
