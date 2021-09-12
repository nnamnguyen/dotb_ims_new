<?php
//tam off
// $dictionary['Account']['fields']['c_sitedeployment_parent'] = array(
//     'name' => 'c_sitedeployment_parent',
//     'type' => 'link',
//     'relationship' => 'account_c_sitedeployment_parent',
//     'source' => 'non-db',
//     'vname' => 'LBL_PARENT',
//     'reportable' => false
// );

// $dictionary['Account']['relationships']['account_c_sitedeployment_parent'] = array(
//     'lhs_module' => 'Accounts',
//     'lhs_table' => 'accounts',
//     'lhs_key' => 'id',
//     'rhs_module' => 'C_SiteDeployment',
//     'rhs_table' => 'c_sitedeployment',
//     'rhs_key' => 'parent_id',
//     'relationship_type' => 'one-to-many',
//     'relationship_role_column' => 'parent_type',
//     'relationship_role_column_value' => 'Accounts',
// );
//////////////////////////////////////////////////////////////////////
$dictionary['Account']['fields']['quote_parent'] = array(
    'name' => 'quote_parent',
    'type' => 'link',
    'relationship' => 'account_quote_parent',
    'source' => 'non-db',
    'vname' => 'LBL_PARENT',
    'reportable' => false
);

$dictionary['Account']['relationships']['account_quote_parent'] = array(
    'lhs_module' => 'Accounts',
    'lhs_table' => 'accounts',
    'lhs_key' => 'id',
    'rhs_module' => 'Quotes',
    'rhs_table' => 'quotes',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Accounts',
);

$dictionary['Account']['fields']['paymentdetail_parent'] = array(
    'name' => 'paymentdetail_parent',
    'type' => 'link',
    'relationship' => 'account_paymentdetail_parent',
    'source' => 'non-db',
    'vname' => 'LBL_PARENT',
    'reportable' => false
);

$dictionary['Account']['relationships']['account_paymentdetail_parent'] = array(
    'lhs_module' => 'Accounts',
    'lhs_table' => 'accounts',
    'lhs_key' => 'id',
    'rhs_module' => 'J_PaymentDetail',
    'rhs_table' => 'j_paymentdetail',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Accounts',
);
