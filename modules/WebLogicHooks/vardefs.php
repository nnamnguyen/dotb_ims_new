<?php

$dictionary['WebLogicHook'] = array(
    'table' => 'weblogichooks',
    'favorites'=>false,
    'comment' => 'Web Logic Hooks',
    'audited' => false,
    'activity_enabled'=>false,
    'unified_search' => false,
    'unified_search_default_enabled' => false,
    'full_text_search' => false,
    'optimistic_locking' => true,
    'fields' => array(
        'name' => array(
            'name' => 'name',
            'vname' => 'LBL_NAME',
            'type' => 'name',
            'dbType' => 'varchar',
            'len' => '255',
            'comment' => 'Hook name',
            'required' => true,
        ),
        'webhook_target_module' => array(
            'name' => 'webhook_target_module',
            'vname' => 'LBL_TARGET_NAME',
            'type' => 'enum',
            'options' => 'moduleList',
            'required' => true,
        ),
        'request_method' => array(
            'name' => 'request_method',
            'vname' => 'LBL_REQUEST_METHOD',
            'type' => 'enum',
            'options' => 'web_hook_request_method_list',
            'default' => 'POST',
            'required' => true,
        ),
        'url' => array(
            'name' => 'url',
            'vname' => 'LBL_URL',
            'type' => 'varchar',
            'len' => '255',
            'comment' => 'URL of website for the company',
            'required' => true,
        ),
        'trigger_event' => array(
            'name' => 'trigger_event',
            'vname' => 'LBL_TRIGGER_EVENT',
            'type' => 'enum',
            'options' => 'webLogicHookList',
            'required' => true,
        ),
    ),
    'acls' => array(
        'DotbACLAdminOnly' => array(
            'adminFor' => 'Users',
        ),
    ),
    // @TODO Fix the Default and Basic DotbObject templates so that Basic
    // implements Default. This would allow the application of various
    // implementations on Basic without forcing Default to have those so that
    // situations like this - implementing taggable - doesn't have to apply to
    // EVERYTHING. Since there is no distinction between basic and default for
    // dotb objects templates yet, we need to forecefully remove the taggable
    // implementation fields. Once there is a separation of default and basic
    // templates we can safely remove these as this module will implement
    // default instead of basic.
    'ignore_templates' => array(
        'taggable',
    ),
);

VardefManager::createVardef(
    'WebLogicHooks',
    'WebLogicHook',
    array(
        'default',
        'basic',
    )
);
