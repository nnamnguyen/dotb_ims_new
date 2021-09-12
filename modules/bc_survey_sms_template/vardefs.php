<?php

/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */

$dictionary['bc_survey_sms_template'] = array(
    'table' => 'bc_survey_sms_template',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array(
        'sms_content' =>
        array(
            'required' => false,
            'name' => 'sms_content',
            'vname' => 'LBL_SMS_CONTENT',
            'type' => 'text',
            'massupdate' => 0,
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
            'size' => '20',
            'dbType' => 'text',
            'studio' => 'visible',
            'rows' => '4',
            'cols' => '20',
        ),
        'sms_sync_module_list' =>
        array(
            'required' => false,
            'name' => 'sms_sync_module_list',
            'vname' => 'LBL_SMS_SYNC_MODULE_LIST',
            'type' => 'enum',
            'dbType' => 'multienum',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'studio' => 'visible',
            'dependency' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'sync_module_list',
        ),
        'sms_field_name' =>
        array(
            'labelValue' => 'Field Name',
            'visibility_grid' =>
            array(
                'trigger' => 'sms_sync_module_list',
                'values' =>
                array(
                    'Accounts' =>
                    array(
                        0 => 'name',
                    ),
                    'Contacts' =>
                    array(
                        0 => 'first_name',
                        1 => 'last_name',
                    ),
                    'Leads' =>
                    array(
                        0 => 'first_name',
                        1 => 'last_name',
                    ),
                    'Prospects' =>
                    array(
                        0 => 'first_name',
                        1 => 'last_name',
                    ),
                ),
            ),
            'required' => false,
            'name' => 'sms_field_name',
            'vname' => 'LBL_SMS_FIELD_NAME',
            'type' => 'enum',
            'dbType' => 'multienum',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => 1,
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'pii' => false,
            'default' => 'name',
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'sms_template_field_list',
            'dependency' => NULL,
        ),
        'sms_survey_linked' =>
        array(
            'name' => 'sms_survey_linked',
            'vname' => 'LBL_SMS_SURVEY_LINKED',
            'type' => 'varchar',
            'link' => true,
            'dbType' => 'varchar',
            'len' => '255',
            'unified_search' => false,
            'required' => true,
            'importable' => 'required',
            'duplicate_merge' => 'disabled',
            'merge_filter' => 'disabled',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'size' => '20',
        ),
    ),
    'relationships' => array(
    ),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')) {
    
}
VardefManager::createVardef('bc_survey_sms_template', 'bc_survey_sms_template', array('basic', 'team_security', 'assignable', 'taggable'));
