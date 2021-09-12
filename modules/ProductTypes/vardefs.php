<?php

$dictionary['ProductType'] = array(
    'table' => 'product_types',
    'favorites' => false,
    'comment' => 'Types of products',
    'fields' => array (
        'description' => array (
            'name' => 'description',
            'vname' => 'LBL_DESCRIPTION',
            'type' => 'text',
            'comment' => 'Product type description',
            'massupdate' => true,
            'sortable' => false,
        ),
        'list_order' => array (
            'name' => 'list_order',
            'vname' => 'LBL_LIST_ORDER',
            'type' => 'int',
            'len' => '4',
            'comment' => 'Order within list',
            'importable' => 'required',
            'required' => true,
        ),
    ),
    'acls' => array('DotbACLDeveloperOrAdmin' => array('aclModule' => 'Products', 'allowUserRead' => true)),
    'uses' => array(
        'basic',
    ),
);

VardefManager::createVardef(
    'ProductTypes',
    'ProductType'
);

$dictionary['ProductType']['fields']['tag']['massupdate'] = false;
