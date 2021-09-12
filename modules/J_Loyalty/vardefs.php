<?php



$dictionary['J_Loyalty'] = array(
    'table' => 'j_loyalty',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array (
            'type'=> array (
            'required' => true,
            'name' => 'type',
            'vname' => 'LBL_TYPE',
            'type' => 'enum',
            'massupdate' => 0,
            'default' => '',
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
            'len' => 100,
            'size' => '20',
            'options' => 'loyalty_type_list',
            'studio' => 'visible',
            'dependency' => false,
        ),
        'point' =>
        array (
            'required'  => true,
            'name'      => 'point',
            'vname'     => 'LBL_POINT',
            'type'      => 'varchar',
            'dbType'    => 'int',
            'no_default'=> false,
            'len'       => '100',
            'min'       => '1',
            'max'       => '99999999',
        ),
        'discount_amount' =>
        array (
            'required' => false,
            'name' => 'discount_amount',
            'vname' => 'LBL_DISCOUNT_AMOUNT',
            'type' => 'currency',
            'len' => 26,
            'size' => '20',
            'enable_range_search' => true,
            'options' => 'numeric_range_search_dom',
            'precision' => 6,
            'default' => '',
        ),
        'rate_in_out' =>
        array (
            'required' => false,
            'name' => 'rate_in_out',
            'vname' => 'LBL_RATE_IN_OUT',
            'type' => 'currency',
            'len' => 13,
            'size' => '20',
            'enable_range_search' => true,
            'options' => 'numeric_range_search_dom',
            'precision' => 6,
            'default' => '',
        ),
        'exp_date' =>
        array (
            'required' => true,
            'name' => 'exp_date',
            'vname' => 'LBL_EXP_DATE',
            'type' => 'date',
            'massupdate' => 0,
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'size' => '20',
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'importable' => 'required',
            'display_default' => '+12 month',
        ),
        'input_date' =>
        array (
            'required' => true,
            'name' => 'input_date',
            'vname' => 'LBL_INPUT_DATE',
            'type' => 'date',
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
            'calculated' => false,
            'size' => '20',
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'importable' => 'required',
            'display_default' => 'now',
        ),
        'paymentdetail_id' => array(
            'name' => 'paymentdetail_id',
            'vname' => 'LBL_PAYMENT_DETAIL_NAME',
            'type' => 'id',
            'required'=>false,
            'reportable'=>false,
            'comment' => ''
        ),
        'paymentdetail_name' => array(
            'name' => 'paymentdetail_name',
            'rname' => 'name',
            'id_name' => 'paymentdetail_id',
            'vname' => 'LBL_PAYMENT_DETAIL_NAME',
            'type' => 'relate',
            'link' => 'paymentdetail_link',
            'table' => 'j_paymentDetail',
            'isnull' => 'true',
            'module' => 'J_PaymentDetail',
            'dbType' => 'varchar',
            'len' => 'id',
            'reportable'=>true,
            'source' => 'non-db',
        ),
        'paymentdetail_link' => array(
            'name' => 'paymentdetail_link',
            'type' => 'link',
            'relationship' => 'paymentdetail_loyaltys',
            'link_type' => 'one',
            'side' => 'right',
            'source' => 'non-db',
            'vname' => 'LBL_PAYMENT_DETAIL_NAME',
        ),
        //END: Add Relationship Receipt - Loyalty
),
    'relationships' => array (

),
    'optimistic_locking' => true,
    'unified_search' => false,
    'full_text_search' => false,
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('J_Loyalty','J_Loyalty', array('basic','team_security','assignable','taggable'));