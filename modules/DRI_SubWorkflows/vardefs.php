<?php

$dictionary['DRI_SubWorkflow'] = array (
    'table' => 'dri_subworkflows',
    'audited' => true,
    'unified_search' => false,
    'duplicate_merge' => true,
    'comment' => 'DRI_SubWorkflow',
    'fields' => array (),
    'relationships' => array (),
    'indices' => array (),
    'optimistic_lock' => true,
    'uses' => array (
        'default',
        'team_security',
        'assignable',
    ),
);

VardefManager::createVardef(
    'DRI_SubWorkflows',
    'DRI_SubWorkflow'
);
