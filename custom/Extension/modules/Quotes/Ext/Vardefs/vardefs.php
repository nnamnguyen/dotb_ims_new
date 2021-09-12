<?php
$dictionary['Quote']['fields']['paid_amount'] = array(
    'name' => 'paid_amount',
    'vname' => 'LBL_PAID_AMOUNT',
    'dbType' => 'decimal',
    'type' => 'currency',
    'len' => '26,6',
    'studio' => 'visible',
    'default' => '0'
);

$dictionary['Quote']['fields']['unpaid_amount'] = array(
    'name' => 'unpaid_amount',
    'vname' => 'LBL_UNPAID_AMOUNT',
    'dbType' => 'decimal',
    'type' => 'currency',
    'len' => '26,6',
    'studio' => 'visible',
    'default' => '0',
    'formula' => 'subtract(number($total),number($paid_amount))',
    'calculated' => true,
    'enforced' => true,
);

$dictionary['Quote']['fields']['current_text'] = array(
    'name' => 'current_text',
    'type' => 'varchar',
    'label' => 'LBL_CURRENT_TEXT',
    'len' => '100',
    'source' => 'non-db',
);
$dictionary['Quote']['fields']['list_balance'] = array(
    'name' => 'list_balance',
    'type' => 'selection_item',
    'vname' => 'LBL_LIST_BALANCE',
    'source' => 'non-db'
);
$dictionary['Quote']['fields']['use_free_balance'] = array(
    'name' => 'use_free_balance',
    'vname' => 'LBL_USE_FREE_BALANCE',
    'type' => 'currency',
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
    'pii' => false,
    'default' => 0.0,
    'calculated' => true,
    'len' => 26,
    'size' => '20',
    'enable_range_search' => false,
    'precision' => 2,
    'related_fields' =>
    array(
        0 => 'currency_id',
        1 => 'base_rate',
    ),
);
// Dùng riêng cho Flex related field (nnamnguyen)
$dictionary['Quote']['fields']['parent_type'] = array(
    'name' => 'parent_type',
    'vname' => 'LBL_PARENT_TYPE',
    'type' => 'parent_type',
    'dbType' => 'varchar',
    'required' => false,
    'group' => 'parent_name',
    // 'options' => 'parent_type_display_custom',
    'options' => 'parent_type_display_custom_of_quotes',
    'len' => 255,
    'studio' => array('wirelesslistview' => false),
    'comment' => 'The Dotb object to which the call is related',
    'default' => 'Accounts'
);
//Dùng chung cho 1-n và Flex related fiels (nnamnguyen)
$dictionary['Quote']['fields']['parent_id'] = array(
    'name' => 'parent_id',
    'vname' => 'LBL_LIST_RELATED_TO_ID',
    'type' => 'id',
    'group' => 'parent_name',
    'reportable' => false,
    'comment' => 'The ID of the parent Dotb object identified by parent_type',
    'required' => true
);
//Dùng chung cho 1-n và Flex related fiels (nnamnguyen)
$dictionary['Quote']['fields']['parent_name'] = array(
    'name' => 'parent_name',
    'parent_type' => 'record_type_display',
    'type_name' => 'parent_type',
    'id_name' => 'parent_id',
    // 'vname' => 'LBL_LIST_RELATED_TO',// for flex related field
    'vname' => 'LBL_RELATED_TO_ACCOUNT',
    // 'type' => 'parent',// for flex related field

    //add new prop by nnamnguyen
    'type' => 'relate',
    'link' => 'quotes_accounts_link',
    'table' => 'accounts',
    'module' => 'Accounts',

    'group' => 'parent_name',
    'source' => 'non-db',
    // 'options' => 'parent_type_display_custom',// for flex related field
    // 'options' => 'parent_type_display_custom_of_quotes',// for flex related field
    'studio' => true,
    'required' => true,
    'auto_populate' => true,
    //    'populate_list' => array(
    //        'primary_address_street'=>'billing_address_street',
    //        'primary_address_city'=>'billing_address_city',
    //        'primary_address_state'=> 'billing_address_state',
    //        'primary_address_postalcode'=>'billing_address_postalcode',
    //        'primary_address_country'=>'billing_address_country'
    //    ),
);
// Add new field link for relationship 1-n by nnamnguyen do ban đầu chưa có qh 1-n mà đang dùng flex related field chỉ để chọn cho riêng account (không có module khác)
$dictionary["Quote"]["fields"]["quotes_accounts_link"] = array(
    'name' => 'quotes_accounts_link',
    'type' => 'link',
    'relationship' => 'quotes_accounts',
    'source' => 'non-db',
    'module' => 'Accounts',
    'bean_name' => 'Account',
    'side' => 'right',
    'vname' => 'LBL_ACCOUNTS_QUOTES_FROM_QUOTES_TITLE',
    'id_name' => 'accounts_quotes_accounts_ida',
    'link-type' => 'one',
);

$dictionary['Quote']['fields']['total_balance_parent'] = array(
    'name' => 'total_balance_parent',
    'vname' => 'LBL_TOTAL_AMOUNT',
    'dbType' => 'decimal',
    'type' => 'currency',
    'len' => '26,6',
    'studio' => 'visible',
    'default' => '0',
    'source' => 'non-db',
);
$dictionary['Quote']['fields']['order_date'] = array(
    'name' => 'order_date',
    'vname' => 'LBL_ORDER_DATE',
    'dbType' => 'date',
    'type' => 'jdate',
);
$dictionary['Quote']['fields']['number_of_payment'] = array(
    'name' => 'number_of_payment',
    'vname' => 'LBL_NUMBER_OF_PAYMENT',
    'type' => 'enum',
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
    'pii' => false,
    'default' => '',
    'calculated' => false,
    'len' => 100,
    'size' => '20',
    'options' => 'number_of_payment_list',
    'dependency' => false,
);
$dictionary['Quote']['fields']['num_month_pay'] = array(
    'name' => 'num_month_pay',
    'vname' => 'LBL_NUM_MONTH_PAY',
    'type' => 'int',
    'len' => '10',
    'size' => '20',
    'min' => false,
    'max' => false,
    'dependency' => 'equal($number_of_payment,"Monthly-plan")',
);
$dictionary['Quote']['fields']['payment_info'] = array(
    'name' => 'payment_info',
    'vname' => 'LBL_PAYMENT_INFO',
    'type' => 'payment_info',
    'source' => 'non-db',
);
$dictionary['Quote']['fields']['list_receipt'] = array(
    'name' => 'list_receipt',
    'vname' => 'LBL_LIST_RECEIPT',
    'type' => 'varchar',
    'source' => 'non-db',
    'len' => 1000,
    'size' => '20',
);

$dictionary['Quote']['fields']['use_balance_from_receipt_amount'] = array(
    'name' => 'use_balance_from_receipt_amount',
    'vname' => 'LBL_USE_FREE_BALANCE',
    'dbType' => 'decimal',
    'type' => 'currency',
    'len' => '26',
    'studio' => 'visible',
    'default' => '0',
    'source' => 'non-db',
);
// Add new field by nnamnguyen
$dictionary['Quote']['fields']['use_discount'] = array(
    'name' => 'use_discount',
    'vname' => 'LBL_USE_DISCOUNT',
    'source' => 'non-db',
    'type' => 'int',
    'len' => '10',
);
