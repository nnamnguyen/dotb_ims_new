<?php

$dictionary['Manufacturer'] = array(
    'table' => 'manufacturers',
    'favorites' => false,
    'comment' => 'Manufacturers',
    'unified_search' => true,
    'full_text_search' => true,
    'unified_search_default_enabled' => true,
    'fields' => array (
        'list_order' => array (
            'name' => 'list_order',
            'vname' => 'LBL_LIST_ORDER',
            'type' => 'int',
            'len' => '4',
            'comment' => 'Order within list',
            'importable' => 'required',
        ),
        'status' => array (
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'options' => 'manufacturer_status_dom',
            'len' => 100,
            'dbType'=>'varchar',
            'comment' => 'Manufacturer status',
            'importable' => 'required',
        ),
        'revenue_line_items' => array(
            'name' => 'revenue_line_items',
            'type' => 'link',
            'relationship' => 'revenuelineitems_manufacturers',
            'source' => 'non-db',
            'vname' => 'LBL_REVENUELINEITEMS',
            'workflow' => false,
        ),
    ),
    'acls' => array(
        'DotbACLDeveloperOrAdmin' => array(
            'aclModule' => 'Products',
            'allowUserRead' => true,
        ),
        'DotbACLStatic' => false,
    ),
    'uses' => array(
        'basic',
    ),
);

VardefManager::createVardef(
    'Manufacturers',
    'Manufacturer'
);

$dictionary['Manufacturer']['fields']['tag']['massupdate'] = false;
