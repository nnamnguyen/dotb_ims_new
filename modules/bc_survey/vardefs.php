<?php

/**
 * The file used to handle fields definition for survey
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$dictionary['bc_survey'] = array(
    'table' => 'bc_survey',
    'audited' => true,
    'duplicate_merge' => true,
    'fields' => array(
        'name' =>
        array(
            'name' => 'name',
            'vname' => 'LBL_NAME',
            'type' => 'name',
            'link' => true,
            'dbType' => 'varchar',
            'len' => '255',
            'unified_search' => false,
            'full_text_search' =>
            array(
                'boost' => 3,
            ),
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
        'email_template_subject' =>
        array(
            'name' => 'email_template_subject',
            'vname' => 'LBL_EMAIL_TEMPLATE_SUBJECT',
            'type' => 'name',
            'link' => true,
            'dbType' => 'varchar',
            'len' => '255',
            'unified_search' => false,
            'full_text_search' =>
            array(
                'boost' => 3,
            ),
            'required' => false,
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
        'start_date' =>
        array(
            'required' => false,
            'name' => 'start_date',
            'vname' => 'LBL_START_DATE',
            'type' => 'datetimecombo',
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
            'enable_range_search' => false,
            'dbType' => 'datetime',
        ),
        'end_date' =>
        array(
            'required' => false,
            'name' => 'end_date',
            'vname' => 'LBL_END_DATE',
            'type' => 'datetimecombo',
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
            'enable_range_search' => false,
            'dbType' => 'datetime',
        ),
        'survey_logo' =>
        array(
            'labelValue' => 'Survey Logo',
            'dependency' => '',
            'required' => false,
            'name' => 'survey_logo',
            'vname' => 'LBL_SURVEY_LOGO',
            'type' => 'image',
            'massupdate' => false,
            'default' => NULL,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 255,
            'size' => '20',
            'dbType' => 'varchar',
            'width' => '96',
            'height' => '60',
        ),
        'survey_theme' =>
        array(
            'labelValue' => 'Survey Theme',
            'dependency' => '',
            'visibility_grid' => '',
            'required' => false,
            'name' => 'survey_theme',
            'vname' => 'LBL_SURVEY_THEME',
            'type' => 'radioenum',
            'massupdate' => true,
            'default' => 'theme0',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'theme_list',
            'dbType' => 'enum',
            'separator' => '<br>',
        ),
        'email_template' =>
        array(
            'required' => false,
            'name' => 'email_template',
            'vname' => 'LBL_EMAIL_TEMPLATE',
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
            'studio' => 'visible',
            'rows' => '4',
            'cols' => '20',
        ),
        'surveypages' =>
        array(
            'labelValue' => 'Survey Pages',
            'enforced' => '',
            'dependency' => '',
            'required' => false,
            'name' => 'surveypages',
            'vname' => 'LBL_SURVEYPAGES',
            'type' => 'AddSurveyPagefield',
            'massupdate' => false,
            'default' => '1',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => '255',
            'size' => '20',
            'dbType' => 'varchar',
        ),
        'redirect_url' =>
        array(
            'name' => 'redirect_url',
            'vname' => 'LBL_REDIRECT_URL',
            'type' => 'url',
            'dbType' => 'varchar',
            'len' => 255,
            'comment' => 'URL of redirect after survey is submitted',
        ),
        'allowed_resubmit_count' =>
        array(
            'required' => false,
            'name' => 'allowed_resubmit_count',
            'vname' => 'LBL_ALLOWED_RESUBMIT_COUNT',
            'type' => 'int',
            'dbType' => 'varchar',
            'massupdate' => 0,
            'default' => '0',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'len' => 11,
            'size' => '20',
            'studio' => 'visible',
            'dependency' => false,
        ),
        'is_progress' =>
        array(
            'required' => false,
            'name' => 'is_progress',
            'vname' => 'LBL_IS_PROGRESS',
            'type' => 'bool',
            'massupdate' => 0,
            'default' => '1',
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
            'len' => '255',
            'studio' => 'visible',
            'size' => '20',
        ),
        'image' =>
        array(
            'required' => false,
            'name' => 'image',
            'vname' => 'Image',
            'type' => 'text',
            'dbType' => 'longblob',
            'massupdate' => 0,
            'default' => '',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'dependency' => false,
        ),
        'base_score' =>
        array(
            'required' => false,
            'name' => 'base_score',
            'vname' => 'LBL_BASE_SCORE',
            'type' => 'int',
            'len' => 11,
            'isnull' => 'false',
            'unified_search' => true,
            'comments' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'reportable' => true,
            'disable_num_format' => true,
        ),
        'survey_welcome_page' =>
        array(
            'required' => false,
            'name' => 'survey_welcome_page',
            'type' => 'text',
            'dbType' => 'text',
            'vname' => 'LBL_WELCOME_PAGE',
        ),
        'survey_thanks_page' =>
        array(
            'required' => false,
            'name' => 'survey_thanks_page',
            'type' => 'text',
            'dbType' => 'text',
            'vname' => 'LBL_THANKS_PAGE',
        ),
        'enable_review_mail' =>
        array(
            'required' => false,
            'name' => 'enable_review_mail',
            'vname' => 'LBL_ENABLE_REVIEW_MAIL',
            'type' => 'bool',
            'massupdate' => 0,
            'default' => 0,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'studio' => 'visible',
        ),
        'review_mail_content' =>
        array(
            'required' => false,
            'name' => 'review_mail_content',
            'type' => 'text',
            'dbType' => 'text',
            'default' => '',
            'dependency' => 'equal($enable_review_mail,1)'
        ),
        'default_survey_language' =>
        array(
            'dependency' => '',
            'visibility_grid' => '',
            'required' => false,
            'name' => 'default_survey_language',
            'vname' => 'LBL_DEFAULT_SURVEY_LANGUAGE',
            'type' => 'enum',
            'massupdate' => true,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'available_language_dom',
            'dbType' => 'enum',
            'separator' => '<br>',
        ),
        'supported_survey_language' =>
        array(
            'dependency' => '',
            'visibility_grid' => '',
            'required' => false,
            'name' => 'supported_survey_language',
            'vname' => 'LBL_SUPPORTED_SURVEY_LANGUAGE',
            'type' => 'multienum',
            'massupdate' => true,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'options' => 'available_language_dom',
            'dbType' => 'multienum',
            'separator' => '<br>',
        ),
        'survey_type' =>
        array(
            'required' => false,
            'name' => 'survey_type',
            'vname' => 'LBL_SURVEY_TYPE',
            'type' => 'varchar',
            'dbType' => 'varchar',
            'massupdate' => 0,
            'no_default' => false,
            'default' => 'survey',
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'studio' => 'visible',
            'dependency' => false,
        ),
        'allow_redundant_answers' =>
        array(
            'required' => false,
            'name' => 'allow_redundant_answers',
            'vname' => 'LBL_ALLOW_REDUNDANT_ANSWERS',
            'type' => 'bool',
            'massupdate' => 0,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'studio' => 'visible',
        ),
        'survey_submit_unique_id' =>
        array(
            'name' => 'survey_submit_unique_id',
            'vname' => 'LBL_SURVEY_SUBMIT_UNIQUE_ID',
            'type' => 'text',
            'readonly' => true,
            'dbType' => 'varchar',
            'comment' => '',
        ),
        'web_link_counter' =>
        array(
            'required' => false,
            'name' => 'web_link_counter',
            'vname' => 'LBL_WEB_LINK_COUNTER',
            'type' => 'int',
            'len' => 11,
            'default' => 0,
            'isnull' => 'false',
            'unified_search' => true,
            'comments' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'reportable' => true,
            'disable_num_format' => true,
        ),
        'enable_data_piping' =>
        array(
            'required' => false,
            'name' => 'enable_data_piping',
            'vname' => 'LBL_ENABLE_DATA_PIPING',
            'type' => 'bool',
            'massupdate' => 0,
            'comments' => '',
            'default' => 0,
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'studio' => 'visible',
        ),
        'sync_module' =>
        array(
            'dependency' => '',
            'visibility_grid' => '',
            'required' => false,
            'name' => 'sync_module',
            'vname' => 'LBL_SYNC_MODULE',
            'type' => 'enum',
            'massupdate' => true,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'sync_module_list',
            'dbType' => 'enum',
            'separator' => '<br>',
        // 'dependency' => 'equal($enable_data_piping,1)'
        ),
        'sync_type' =>
        array(
            'dependency' => '',
            'visibility_grid' => '',
            'required' => false,
            'name' => 'sync_type',
            'vname' => 'LBL_SYNC_TYPE',
            'type' => 'enum',
            'massupdate' => true,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'sync_type_list',
            'dbType' => 'enum',
            'separator' => '<br>',
        // 'dependency' => 'equal($enable_data_piping,1)'
        ),
        'survey_send_status' =>
        array(
            'required' => false,
            'name' => 'survey_send_status',
            'vname' => 'LBL_SURVEY_SEND_STATUS',
            'type' => 'enum',
            'options' => 'survey_status_list',
            'massupdate' => 0,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'len' => '255',
            'studio' => false,
            'default' => 'inactive',
            'readonly' => true,
        ),
        'footer_content' =>
        array(
            'name' => 'footer_content',
            'vname' => 'LBL_FOOTER_AREA',
            'type' => 'text',
            'inline_edit' => false,
        ),
        // Survey Status :: LoadedTech Customization
        'survey_status' =>
        array(
            'required' => false,
            'name' => 'survey_status',
            'vname' => 'LBL_SURVEY_STATUS',
            'type' => 'enum',
            'options' => 'survey_status_list',
            'default' => 'Active',
            'massupdate' => 0,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'len' => '255',
            'studio' => true,
            'readonly' => true,
        ),
        // Survey Status :: LoadedTech Customization END
        'survey_background_image' =>
        array(
            'labelValue' => 'Survey Background Image',
            'dependency' => '',
            'required' => false,
            'name' => 'survey_background_image',
            'vname' => 'LBL_SURVEY_BACKGROUND_IMAGE',
            'type' => 'image',
            'massupdate' => false,
            'default' => NULL,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 255,
            'size' => '20',
            'dbType' => 'varchar',
            'width' => '96',
            'height' => '60',
        ),
        'background_image_lb' =>
        array(
            'required' => false,
            'name' => 'background_image_lb',
            'vname' => 'Background Image',
            'type' => 'text',
            'dbType' => 'longblob',
            'massupdate' => 0,
            'default' => '',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'dependency' => false,
        ),
        'recursive_email' =>
        array(
            'required' => false,
            'name' => 'recursive_email',
            'vname' => 'LBL_RECURSIVE_EMAIL',
            'type' => 'bool',
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
            'len' => '255',
            'studio' => 'visible',
            'size' => '20',
        ),
        'resend_count' =>
        array(
            'required' => false,
            'name' => 'resend_count',
            'vname' => 'LBL_RESEND_COUNT',
            'type' => 'int',
            'len' => 2,
            'default' => 1,
            'isnull' => 'false',
            'unified_search' => true,
            'comments' => '',
            'min' => 1,
            'max' => 99,
            'disable_num_format' => 1,
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'reportable' => true,
            'disable_num_format' => true,
            'dependency' => 'equal($recursive_email,1)'
        ),
        'resend_interval' =>
        array(
            'required' => false,
            'name' => 'resend_interval',
            'vname' => 'LBL_INTERVAL',
            'type' => 'enum',
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
            'len' => 100,
            'size' => '20',
            'options' => 'interval_list',
            'studio' => 'visible',
            'dependency' => false,
            'dependency' => 'equal($recursive_email,1)'
        ),
        'enable_individual_report' =>
        array(
            'required' => false,
            'name' => 'enable_individual_report',
            'vname' => 'LBL_ENABLE_INDIVIDUAL_REPORT',
            'type' => 'bool',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => 'Mark true if you want to show Survey Individual Reports to all the Users without any restriction',
            'help' => 'Mark true if you want to show Survey Individual Reports to all the Users without any restriction',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'len' => '255',
            'studio' => 'visible',
            'size' => '20',
        ),
        'enable_agreement' =>
        array(
            'required' => false,
            'name' => 'enable_agreement',
            'vname' => 'LBL_ENABLE_AGREEMENT',
            'type' => 'bool',
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
            'len' => '255',
            'studio' => 'visible',
            'size' => '20',
        ),
        'is_required_agreement' =>
        array(
            'required' => false,
            'name' => 'is_required_agreement',
            'vname' => 'LBL_IS_REQUIRED_AGREEMENT',
            'type' => 'bool',
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
            'len' => '255',
            'studio' => 'visible',
            'size' => '20',
            'dependency' => 'equal($enable_agreement,1)'
        ),
        'agreement_content' =>
        array(
            'required' => true,
            'name' => 'agreement_content',
            'vname' => 'LBL_AGRREMENT_TEXT',
            'type' => 'text',
            'massupdate' => 0,
            'default' => 'Do you consent with your data being processed as described above?',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'dependency' => false,
            'dependency' => 'equal($enable_agreement,1)'
        ),
        'form_seen' =>
        array(
            'required' => false,
            'name' => 'form_seen',
            'vname' => 'form_seen',
            'type' => 'bool',
            'massupdate' => 0,
            'default' => 0,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'len' => '255',
            'studio' => 'visible',
            'size' => '20',
        ),
    ),
    'relationships' => array(
    ),
    'optimistic_locking' => true,
    'unified_search' => true,
);
if (!class_exists('VardefManager')) {
    require_once('include/DotbObjects/VardefManager.php');
}
VardefManager::createVardef('bc_survey', 'bc_survey', array('basic', 'team_security', 'assignable'));
