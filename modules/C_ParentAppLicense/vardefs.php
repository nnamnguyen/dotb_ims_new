<?php


$dictionary['C_ParentAppLicense'] = array(
    'table' => 'c_parentapplicense',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array(
        'total' =>
            array(
                'required' => true,
                'name' => 'total',
                'vname' => 'LBL_TOTAL',
                'type' => 'int',
                'massupdate' => false,
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
                'pii' => false,
                'default' => '0',
                'full_text_search' =>
                    array(
                        'enabled' => '0',
                        'boost' => '1',
                        'searchable' => false,
                    ),
                'calculated' => false,
                'len' => '11',
                'size' => '20',
                'enable_range_search' => false,
                'disable_num_format' => '',
                'min' => false,
                'max' => false,
            ),
        'status' => array(
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'options' => 'parent_app_license_status_options',
            'source' => 'non-db'
        ),
        'package' => array(
            'name' => 'package',
            'vname' => 'LBL_PACKEAGE_LICENSE',
            'type' => 'enum',
            'options' => 'parent_app_license_package_options',
            'required'=>true
        ),
        'used' =>
            array(
                'required' => false,
                'name' => 'used',
                'vname' => 'LBL_USED',
                'type' => 'int',
                'massupdate' => false,
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
                'pii' => false,
                'default' => '0',
                'full_text_search' =>
                    array(
                        'enabled' => '0',
                        'boost' => '1',
                        'searchable' => false,
                    ),
                'calculated' => false,
                'len' => '11',
                'size' => '20',
                'enable_range_search' => false,
                'disable_num_format' => '',
                'min' => false,
                'max' => false,
            ),
        'expired' =>
            array(
                'required' => true,
                'name' => 'expired',
                'vname' => 'LBL_EXPIRED',
                'type' => 'date',
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
                'pii' => false,
                'calculated' => false,
                'size' => '20',
                'enable_range_search' => false,
            ),
        'start' =>
            array(
                'required' => true,
                'name' => 'start',
                'vname' => 'LBL_DATE_START',
                'type' => 'date',
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
                'pii' => false,
                'calculated' => false,
                'size' => '20',
                'enable_range_search' => false,
            ),
    ),
    'relationships' => array(),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')) {
}
VardefManager::createVardef('C_ParentAppLicense', 'C_ParentAppLicense', array('basic', 'team_security', 'assignable', 'taggable'));
