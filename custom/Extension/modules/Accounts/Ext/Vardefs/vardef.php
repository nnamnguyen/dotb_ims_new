<?php
$dictionary['Account']['fields']['international_name'] = array (
    'name' => 'international_name',
    'vname' => 'LBL_INTERNATIONAL_NAME',
    'type' => 'varchar',
    'len'=>255
);
$dictionary['Account']['fields']['business_code'] = array (
    'name' => 'business_code',
    'vname' => 'LBL_BUSINESS_CODE',
    'type' => 'varchar',
    'len'=>255
);
$dictionary['Account']['fields']['date_of_issue'] = array (
    'name' => 'date_of_issue',
    'vname' => 'LBL_DATE_OF_ISSUE',
    'type' => 'date',
);
$dictionary['Account']['duplicate_check'] = array(
    'enabled' => true,
    'FilterDuplicateCheck' => array(
        'filter_template' => array(
            array(
                '$and' => array(
                    array('name' => array('$equals' => '$name')),
                    array('phone_office' => array('$equals' => '$phone_office')),
                )
            ),
        ),
        'ranking_fields' => array(
            array('in_field_name' => 'name', 'dupe_field_name' => 'name'),
            array('in_field_name' => 'billing_address_city', 'dupe_field_name' => 'billing_address_city'),
            array('in_field_name' => 'shipping_address_city', 'dupe_field_name' => 'shipping_address_city'),
        )
    )
);

$dictionary['Account']['fields']['status'] = array(
    'name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'enum',
    'len' => '100',
    'options' => 'account_status_dom',
    'default' => 'Active',
    'audited' => true,
    'comment' => 'Status of the accounts',
);

$dictionary['Account']['fields']['portal_active'] = array(
    'name' => 'portal_active',
    'vname' => 'LBL_PORTAL_ACTIVE',
    'type' => 'bool',
    'default' => '1',
    'duplicate_on_record_copy' => 'no',
);

$dictionary['Account']['fields']['phone_office']['importable'] = 'required';
$dictionary['Account']['fields']['email']['importable'] = 'required';

$dictionary['Account']['fields']['dri_workflow_template_id']['audited'] = false;
$dictionary['Account']['fields']['dri_workflow_template_name']['audited'] = false;
$dictionary['Account']['fields']['team_set_id']['audited'] = false;

$dictionary['Account']['fields']['phone_office']['required'] = true;
$dictionary['Account']['fields']['email']['required'] = true;

$dictionary['Account']['fields']['picture'] = array(
    'name' => 'picture',
    'vname' => 'LBL_PICTURE_FILE',
    'type' => 'image',
    'dbtype' => 'varchar',
    'massupdate' => false,
    'reportable' => false,
    'comment' => 'Avatar',
    'len' => '255',
    'width' => '42',
    'height' => '42',
    'border' => '',
    'duplicate_on_record_copy' => 'always',
);
// Add new field by nnamnguyen
$dictionary['Account']['fields']['tax_code'] = array(
    'name' => 'tax_code',
    'vname' => 'LBL_TAX_CODE',
    'type' => 'varchar',
    'len' => '10',
);
$dictionary['Account']['fields']['size_of_company'] = array(
    'name' => 'size_of_company',
    'vname' => 'LBL_SIZE_OF_COMPANY',
    'type' => 'enum',
    'options'=>'size_of_company_options'
);