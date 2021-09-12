<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/CJ_WebHooks/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['CJ_WebHook']['fields']['url'] = array (
  'name' => 'url',
  'vname' => 'LBL_URL',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
);

$dictionary['CJ_WebHook']['fields']['error_message_path'] = array (
  'name' => 'error_message_path',
  'vname' => 'LBL_ERROR_MESSAGE_PATH',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
  'default' => 'message',
);

$dictionary['CJ_WebHook']['fields']['sort_order'] = array (
  'name' => 'sort_order',
  'vname' => 'LBL_SORT_ORDER',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 1,
);

$dictionary['CJ_WebHook']['fields']['request_method'] = array (
  'name' => 'request_method',
  'vname' => 'LBL_REQUEST_METHOD',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'cj_webhooks_request_method_list',
  'type' => 'enum',
  'default' => 'GET',
);

$dictionary['CJ_WebHook']['fields']['request_format'] = array (
  'name' => 'request_format',
  'vname' => 'LBL_REQUEST_FORMAT',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'cj_webhooks_request_format_list',
  'type' => 'enum',
  'default' => 'json',
);

$dictionary['CJ_WebHook']['fields']['response_format'] = array (
  'name' => 'response_format',
  'vname' => 'LBL_RESPONSE_FORMAT',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'cj_webhooks_response_format_list',
  'type' => 'enum',
  'default' => 'json',
);

$dictionary['CJ_WebHook']['fields']['trigger_event'] = array (
  'name' => 'trigger_event',
  'vname' => 'LBL_TRIGGER_EVENT',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'cj_webhooks_trigger_event_list',
  'type' => 'enum',
  'default' => 'before_create',
  'visibility_grid' => 
  array (
    'trigger' => 'parent_type',
    'values' => 
    array (
      'DRI_Workflow_Task_Templates' => 
      array (
        0 => 'before_create',
        1 => 'after_create',
        2 => 'before_in_progress',
        3 => 'after_in_progress',
        4 => 'before_completed',
        5 => 'after_completed',
        6 => 'before_not_applicable',
        7 => 'after_not_applicable',
      ),
      'DRI_SubWorkflow_Templates' => 
      array (
        0 => 'before_create',
        1 => 'after_create',
        2 => 'before_in_progress',
        3 => 'after_in_progress',
        4 => 'before_completed',
        5 => 'after_completed',
      ),
      'DRI_Workflow_Templates' => 
      array (
        0 => 'before_create',
        1 => 'after_create',
        2 => 'before_in_progress',
        3 => 'after_in_progress',
        4 => 'before_completed',
        5 => 'after_completed',
        6 => 'before_delete',
        7 => 'after_delete',
      ),
    ),
  ),
);

$dictionary['CJ_WebHook']['fields']['headers'] = array (
  'name' => 'headers',
  'vname' => 'LBL_HEADERS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'text',
);

$dictionary['CJ_WebHook']['fields']['ignore_errors'] = array (
  'name' => 'ignore_errors',
  'vname' => 'LBL_IGNORE_ERRORS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => '0',
);

$dictionary['CJ_WebHook']['fields']['active'] = array (
  'name' => 'active',
  'vname' => 'LBL_ACTIVE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => true,
);

$dictionary['CJ_WebHook']['fields']['parent_id'] = array (
  'name' => 'parent_id',
  'vname' => 'LBL_PARENT_ID',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['CJ_WebHook']['fields']['parent_name'] = array (
  'name' => 'parent_name',
  'vname' => 'LBL_PARENT_NAME',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'parent',
  'len' => 255,
  'source' => 'non-db',
  'options' => 'cj_webhooks_parent_type_list',
  'parent_type' => 'cj_webhooks_parent_type_list',
  'id_name' => 'parent_id',
  'type_name' => 'parent_type',
);

$dictionary['CJ_WebHook']['fields']['parent_type'] = array (
  'name' => 'parent_type',
  'vname' => 'LBL_PARENT_TYPE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'parent_type',
  'len' => 255,
  'dbType' => 'varchar',
  'options' => 'cj_webhooks_parent_type_list',
  'parent_type' => 'cj_webhooks_parent_type_list',
);

$dictionary['CJ_WebHook']['indices']['idx_parent_id'] = array (
  'name' => 'idx_parent_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'parent_id',
  ),
);

$dictionary['CJ_WebHook']['duplicate_check']['enabled'] = false;

$dictionary['CJ_WebHook']['acls']['DotbACLAdminOnly'] = true;
