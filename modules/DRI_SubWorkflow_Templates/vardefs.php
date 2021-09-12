<?php

$dictionary['DRI_SubWorkflow_Template'] = array (
    'table' => 'dri_subworkflow_templates',
    'audited' => false,
    'unified_search' => false,
    'duplicate_merge' => true,
    'comment' => 'DRI_SubWorkflow_Template',
    'fields' => array (),
    'relationships' => array (),
    'indices' => array (),
    'optimistic_lock' => true,
    'acls' => array(
        'DotbACLDeveloperOrAdmin' => array (
            'adminFor' => 'DRI_Workflow_Templates',
            'allowUserRead' => true,
        ),
    ),
    'uses' => array(
        'default',
        'team_security',
    ),
);

VardefManager::createVardef(
    'DRI_SubWorkflow_Templates',
    'DRI_SubWorkflow_Template'
);
