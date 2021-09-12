<?php


$dictionary['C_SMS'] = array(
    'table' => 'c_sms',
    'audited' => false,
    'duplicate_merge' => true,
    'fields' => array(
        'phone_number' =>
            array(
                'name' => 'phone_number',
                'vname' => 'LBL_PHONE_NUMBER',
                'type' => 'phone',
                'dbType' => 'varchar',
                'len' => 100,
                'reportable' => true,
                'required' => true,
            ),
        'delivery_status' =>
            array(
                'required' => true,
                'name' => 'delivery_status',
                'vname' => 'LBL_DELIVERY_STATUS',
                'type' => 'enum',
                'duplicate_merge' => 'disabled',
                'duplicate_merge_dom_value' => '0',
                'reportable' => true,
                'len' => 100,
                'options' => 'delivery_status_list',
                'studio' => false,
            ),
        'parent_type' =>
            array(
                'name' => 'parent_type',
                'vname' => 'LBL_PARENT_TYPE',
                'type' => 'parent_type',
                'dbType' => 'varchar',
                'required' => false,
                'group' => 'parent_name',
                'options' => 'izeno_sms_module_selected_list',
                'reportable' => true,
                'len' => 100,
                'comment' => 'The Dotb object to which the call is related'
            ),
        'parent_name' =>
            array(
                'name' => 'parent_name',
                'parent_type' => 'record_type_display',
                'type_name' => 'parent_type',
                'id_name' => 'parent_id',
                'vname' => 'LBL_LIST_RELATED_TO',
                'type' => 'parent',
                'group' => 'parent_name',
                'source' => 'non-db',
                'options' => 'izeno_sms_module_selected_list',
                'studio' => 'visible'
            ),
        'parent_id' =>
            array(
                'name' => 'parent_id',
                'vname' => 'LBL_LIST_RELATED_TO_ID',
                'type' => 'id',
                'group' => 'parent_name',
                'reportable' => true,
                'comment' => 'The ID of the parent Dotb object identified by parent_type',
            ),
        //Custom Relationship Contact
        'student_name' => array(
            'required' => true,
            'source' => 'non-db',
            'name' => 'student_name',
            'vname' => 'LBL_STUDENT_NAME',
            'type' => 'relate',
            'rname' => 'name',
            'id_name' => 'parent_id',
            'join_name' => 'contacts',
            'link' => 'sms_contacts',
            'table' => 'contacts',
            'isnull' => 'true',
            'module' => 'Contacts',
        ),

        'sms_contacts' => array(
            'name' => 'sms_contacts',
            'type' => 'link',
            'relationship' => 'contact_smses',
            'module' => 'Contacts',
            'bean_name' => 'Contact',
            'source' => 'non-db',
            'vname' => 'LBL_STUDENT_NAME',
        ),
        //END

        //Custom Relationship Lead
        'lead_name' => array(
            'required' => true,
            'source' => 'non-db',
            'name' => 'lead_name',
            'vname' => 'LBL_LEAD_NAME',
            'type' => 'relate',
            'rname' => 'name',
            'id_name' => 'parent_id',
            'join_name' => 'leads',
            'link' => 'sms_leads',
            'table' => 'leads',
            'isnull' => 'true',
            'module' => 'Leads',
        ),

        'sms_leads' => array(
            'name' => 'sms_leads',
            'type' => 'link',
            'relationship' => 'lead_smses',
            'module' => 'Leads',
            'bean_name' => 'Lead',
            'source' => 'non-db',
            'vname' => 'LBL_LEAD_NAME',
        ),
        //END
        'date_send' => array(
            'name' => 'date_send',
            'vname' => 'LBL_DATE_SEND',
            'type' => 'date',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => true,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'size' => '20',
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'display_default' => 'now',
            'studio' => false,
        ),
        'date_in_content' => array(
            'name' => 'date_in_content',
            'vname' => 'LBL_DATE_IN_CONTENT',
            'type' => 'date',
            'massupdate' => 0,
            'no_default' => false,
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'size' => '20',
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'display_default' => 'now',
            'studio' => false,
        ),
        'message_count' =>
            array(
                'required' => false,
                'name' => 'message_count',
                'vname' => 'LBL_MESSAGE_COUNT',
                'type' => 'int',
                'massupdate' => 0,
                'help' => 'Number Class',
                'importable' => 'true',
                'duplicate_merge' => 'disabled',
                'duplicate_merge_dom_value' => '0',
                'audited' => false,
                'reportable' => true,
                'unified_search' => false,
                'merge_filter' => 'disabled',
                'calculated' => false,
                'len' => '10',
                'size' => '20',
                'enable_range_search' => false,
                'disable_num_format' => '',
                'min' => false,
                'max' => false,
                'studio' => false,
            ),
        'supplier' =>
            array(
                'name' => 'supplier',
                'vname' => 'LBL_SUPPLIER',
                'type' => 'enum',
                'reportable' => true,
                'unified_search' => false,
                'merge_filter' => 'disabled',
                'calculated' => false,
                'len' => 100,
                'size' => '20',
                'options' => 'sms_supplier_options',
                'studio' => false,
                'dependency' => false,
                'massupdate' => 0,
            ),
        //Custom Relationship  Email template - SMS (1-n)  By Hieu Pham
        'template_name' => array(
            'required' => false,
            'source' => 'non-db',
            'name' => 'template_name',
            'vname' => 'LBL_EMAIL_TEMPLATE_NAME',
            'type' => 'relate',
            'rname' => 'name',
            'id_name' => 'template_id',
            'link' => 'templates_link',
            'table' => 'email_templates',
            'isnull' => 'true',
            'module' => 'EmailTemplates',
        ),

        'template_id' => array(
            'name' => 'template_id',
            'rname' => 'id',
            'vname' => 'LBL_EMAIL_TEMPLATE_ID',
            'type' => 'id',
            'table' => 'email_templates',
            'isnull' => 'true',
            'module' => 'EmailTemplates',
            'dbType' => 'id',
            'reportable' => false,
            'massupdate' => false,
            'duplicate_merge' => 'disabled',
        ),

        'templates_link' => array(
            'name' => 'templates_link',
            'type' => 'link',
            'relationship' => 'emailtemplate_sms',
            'module' => 'EmailTemplates',
            'bean_name' => 'EmailTemplate',
            'source' => 'non-db',
            'vname' => 'LBL_EMAIL_TEMPLATE_NAME',
        ),
    ),
    'relationships' => array(),
    'optimistic_locking' => true,
    'unified_search' => true,
);


if (!class_exists('VardefManager')) {
}
VardefManager::createVardef('C_SMS', 'C_SMS', array('basic', 'assignable', 'taggable'));

$dictionary['C_SMS']['fields']['assigned_user_name']['studio'] = false;
$dictionary['C_SMS']['fields']['assigned_user_id']['studio'] = false;
$dictionary['C_SMS']['fields']['name']['studio'] = false;