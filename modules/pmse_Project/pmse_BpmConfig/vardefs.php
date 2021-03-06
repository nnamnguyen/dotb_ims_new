<?php


$dictionary['pmse_BpmConfig'] = array(
    'table' => 'pmse_bpm_config',
    'audited' => false,
    'activity_enabled' => false,
    'reassignable' => false,
    'duplicate_merge' => true,
    'fields' => array(
        'cfg_status' => array(
            'required' => true,
            'name' => 'cfg_status',
            'vname' => 'step type',
            'type' => 'varchar',
            'massupdate' => false,
            'default' => 'ACTIVE',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => '20',
            'size' => '20',
        ),
        'cfg_value' => array(
            'required' => true,
            'name' => 'cfg_value',
            'vname' => 'script to be executed as part of this ',
            'type' => 'text',
            'massupdate' => false,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'size' => '20',
            'rows' => '4',
            'cols' => '20',
        ),
    ),
    'relationships' => array(),
    'optimistic_locking' => true,
    'unified_search' => true,
    'ignore_templates' => array(
        'taggable',
        'lockable_fields',
    ),
    'uses' => array(
        'basic',
        'assignable',
    ),
);

VardefManager::createVardef('pmse_BpmConfig', 'pmse_BpmConfig');
