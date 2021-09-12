<?php

$dictionary['DRI_Workflow_Template'] = array (
    'table' => 'dri_workflow_templates',
    'audited' => false,
    'unified_search' => false,
    'duplicate_merge' => true,
    'comment' => 'DRI_Workflow_Template',
    'fields' => array (),
    'relationships' => array (),
    'optimistic_lock' => true,
    'acls' => array (
        'DotbACLDeveloperOrAdmin' => array (
            'adminFor' => 'DRI_Workflow_Templates',
            'allowUserRead' => true,
        ),
    ),
    'uses' => array (
        'default',
        'team_security',
    ),
);

VardefManager::createVardef(
    'DRI_Workflow_Templates',
    'DRI_Workflow_Template'
);
