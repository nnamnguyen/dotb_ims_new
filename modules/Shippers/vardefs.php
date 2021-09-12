<?php

$dictionary['Shipper'] = array(
    'table' => 'shippers',
    'favorites' => false,
    'fields' => array (
        'list_order' => array (
            'name' => 'list_order',
            'vname' => 'LBL_LIST_ORDER',
            'type' => 'int',
            'len' => '4',
            'importable' => 'required',
        ),
        'default_cost' => array (
            'name' => 'default_cost',
            'vname' => 'LBL_DEFAULT_COST',
            'type' => 'currency',
            'len' => '26,6',
            'audited'=>true,
            'comment' => 'Default cost (Shown)',
        ),
        'default_cost_usdollar' => array (
            'name' => 'default_cost_usdollar',
            'vname' => 'LBL_DEFAULT_COST_USDOLLAR',
            'type' => 'decimal',
            'len' => '26,6',
            'studio' => array(
                'editview' => false,
                'mobile' => false,
            ),
            'readonly' => true,
            'is_base_currency' => true,
        ),
        'status' => array (
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'options' => 'shipper_status_dom',
            'dbType'=>'varchar',
            'len' => 100,
            'importable' => 'required',
        ),
        'quotes' => array (
            'name' => 'quotes',
            'type' => 'link',
            'relationship' => 'shipper_quotes',
            'vname' => 'LBL_QUOTES',
            'source'=>'non-db',
        ),
    ),
    'acls' => array('DotbACLDeveloperOrAdmin' => array('aclModule' => 'Products', 'allowUserRead' => true)),
    'relationships' => array (
        'shipper_quotes' => array (
            'lhs_module'=> 'Shippers',
            'lhs_table'=> 'shippers',
            'lhs_key' => 'id',
            'rhs_module'=> 'Quotes', 'rhs_table'=> 'quotes', 'rhs_key' => 'shipper_id',
            'relationship_type'=>'one-to-many',
        ),
    ),
    'uses' => array(
        'basic',
    ),
);

VardefManager::createVardef(
    'Shippers',
    'Shipper'
);

$dictionary['Shipper']['fields']['tag']['massupdate'] = false;
