<?php



$dictionary['J_Invoice'] = array(
    'table' => 'j_invoice',
    'audited' => true,
    'activity_enabled' => false,
    'fields' => array (
        'name' => array(
            'name' => 'name',
            'vname' => 'LBL_NAME',
            'type' => 'name',
            'dbType' => 'varchar',
            'len' => 255,
            'unified_search' => true,
            'full_text_search' => array('enabled' => true, 'searchable' => true, 'boost' => 1.55),
            'required' => false,
            'importable' => 'required',
            'duplicate_merge' => 'enabled',
            //'duplicate_merge_dom_value' => '3',
            'merge_filter' => 'selected',
            'duplicate_on_record_copy' => 'always',
        ),
        'invoice_amount' =>
        array (
            'required' => false,
            'name' => 'invoice_amount',
            'vname' => 'LBL_INVOICE_AMOUNT',
            'type' => 'decimal',
            'len' => 13,
            'enable_range_search' => true,
            'options' => 'numeric_range_search_dom',
            'precision' => 0,
        ),
//        'type' =>
//        array (
//            'name' => 'type',
//            'vname' => 'LBL_TYPE',
//            'type' => 'enum',
//            'options'=> 'invoice_type_list',
//            'default' => 'Paper Invoice',
//            'len' => '100',
//            'audited'=> true,
//            'merge_filter' => 'enabled',
//            'massupdate' => true,
//            'required' => true,
//            'importable' => 'false',
//        ),
        'invoice_date' =>
        array (
            'name' => 'invoice_date',
            'vname' => 'LBL_INVOICE_DATE',
            'type' => 'date',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
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
        ),
        'before_discount' =>
        array (
            'name' => 'before_discount',
            'vname' => 'LBL_BEFORE_DISCOUNT',
            'type' => 'decimal',
            'len' => 13,
            'enable_range_search' => true,
            'options' => 'numeric_range_search_dom',
            'precision' => 0,
        ),

        'total_discount_amount' =>
        array (
            'name' => 'total_discount_amount',
            'vname' => 'LBL_DISCOUNT_AMOUNT',
            'type' => 'decimal',
            'len' => 13,
            'enable_range_search' => true,
            'options' => 'numeric_range_search_dom',
            'precision' => 0,
        ),
        'content_vat_invoice' =>
        array (
            'name' => 'content_vat_invoice',
            'vname' => 'LBL_CONTENT_VAT_INVOICE',
            'type' => 'varchar',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => 'Method Note',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => '255',
            'size' => '20',
        ),
        'serial_no' =>
        array (
            'required' => false,
            'name' => 'serial_no',
            'vname' => 'LBL_SERIAL_NO',
            'type' => 'varchar',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => 'Serial No',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => true,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => '50',
            'size' => '20',
        ),
        'pattern' =>
        array (
            'required' => false,
            'name' => 'pattern',
            'vname' => 'LBL_PATTERN',
            'type' => 'varchar',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => 'Serial No',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => true,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => '50',
            'size' => '20',
        ),
        'custom_button' =>
        array (
            'name' => 'custom_button',
            'vname' => 'Button',
            'type' => 'varchar',
            'len' => '1',
            'studio' => 'visible',
            'source' => 'non-db',
        ),
        'status' =>
        array (
            'required' => false,
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'massupdate' => 0,
            'default' => 'Paid',
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
            'len' => 10,
            'size' => '20',
            'options' => 'status_invoice_list',
            'studio' => 'visible',
            'dependency' => false,
        ),
        //CUSTOM RELATIONSHIP
        //Add Relationship Payment - Invoice
        'payment_id' => array(
            'name' => 'payment_id',
            'vname' => 'LBL_PAYMENT_NAME',
            'type' => 'id',
            'required'=>false,
            'reportable'=>false,
            'comment' => ''
        ),

        'payment_name' => array(
            'name' => 'payment_name',
            'rname' => 'name',
            'id_name' => 'payment_id',
            'vname' => 'LBL_PAYMENT_NAME',
            'type' => 'relate',
            'link' => 'payment_link',
            'table' => 'j_payment',
            'isnull' => 'true',
            'module' => 'J_Payment',
            'dbType' => 'varchar',
            'len' => 'id',
            'reportable'=>true,
            'source' => 'non-db',
        ),

        'payment_link' => array(
            'name' => 'payment_link',
            'type' => 'link',
            'relationship' => 'payment_invoices',
            'link_type' => 'one',
            'side' => 'right',
            'source' => 'non-db',
            'vname' => 'LBL_PAYMENT_NAME',
        ),
        // Payment - Invoice
        //Add Relationship Invoice - Receipt
        'paymentdetail_link'=>array(
            'name' => 'paymentdetail_link',
            'type' => 'link',
            'relationship' => 'invoice_paymentdetail',
            'module' => 'J_PaymentDetail',
            'bean_name' => 'J_PaymentDetail',
            'source' => 'non-db',
            'vname' => 'LBL_PAYMENT_DETAIL',
        ),

        'payment_link'=>array(
            'name' => 'payment_link',
            'type' => 'link',
            'relationship' => 'invoice_payment',
            'module' => 'J_Payment',
            'bean_name' => 'J_Payment',
            'source' => 'non-db',
            'vname' => 'LBL_PAYMENT_NAME',
        ),

    ),
    'relationships' => array (
        //Add Relationship Invoice - Receipt
        'invoice_paymentdetail' => array(
            'lhs_module' => 'J_Invoice',
            'lhs_table' => 'j_invoice',
            'lhs_key' => 'id',
            'rhs_module' => 'J_PaymentDetail',
            'rhs_table' => 'j_paymentdetail',
            'rhs_key' => 'invoice_id',
            'relationship_type' => 'one-to-many'
        ),

        'invoice_payment' => array(
            'lhs_module' => 'J_Invoice',
            'lhs_table' => 'j_invoice',
            'lhs_key' => 'id',
            'rhs_module' => 'J_Payment',
            'rhs_table' => 'j_payment',
            'rhs_key' => 'invoice_id',
            'relationship_type' => 'one-to-many'
        ),
    ),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('J_Invoice','J_Invoice', array('basic','team_security','assignable','taggable','file'));
