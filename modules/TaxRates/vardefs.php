<?php

$dictionary['TaxRate'] = array(
    'table' => 'taxrates',
    'favorites' => false,
    'fields' => array(
        'value' => array(
            'name' => 'value',
            'vname' => 'LBL_VALUE',
            'type' => 'decimal',
            'dbType' => 'decimal2',
            'len' => '26,6',
            'importable' => 'required',
            'required' => true,
            'massupdate' => true,
        ),
        'list_order' => array(
            'name' => 'list_order',
            'vname' => 'LBL_LIST_ORDER',
            'type' => 'int',
            'len' => '4',
            'importable' => 'required',
            'required' => true,
        ),
        'status' => array(
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'dbType' => 'varchar',
            'len' => 100,
            'options' => 'taxrate_status_dom',
            'importable' => 'required',
            'required' => true,
        ),
        'product_bundles' => array(
            'name' => 'product_bundles',
            'type' => 'link',
            'relationship' => 'product_bundle_taxrate',
            'module' => 'ProductBundles',
            'bean_name' => 'ProductBundle',
            'source' => 'non-db'
        ),
        'quotes' => array(
            'name' => 'quotes',
            'type' => 'link',
            'relationship' => 'taxrate_quotes',
            'vname' => 'LBL_TAXRATE',
            'source' => 'non-db',
        ),
    ),
    'relationships' => array(
        'taxrate_quotes' => array(
            'lhs_module' => 'TaxRates',
            'lhs_table' => 'taxrates',
            'lhs_key' => 'id',
            'rhs_module' => 'Quotes',
            'rhs_table' => 'quotes',
            'rhs_key' => 'taxrate_id',
            'relationship_type' => 'one-to-many',
        ),
    ),
    'acls' => array('DotbACLDeveloperOrAdmin' => array('aclModule' => 'Quotes', 'allowUserRead' => true))
);

VardefManager::createVardef(
    'TaxRates',
    'TaxRate',
    array(
        'default'
    )
);

$dictionary['TaxRate']['fields']['tag']['massupdate'] = false;
