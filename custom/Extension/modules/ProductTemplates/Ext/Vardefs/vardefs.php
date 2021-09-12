<?php
$dictionary['ProductTemplate']['fields']['code'] = array(
    'name' => 'code',
    'vname' => 'LBL_CODE',
    'dbType' => 'varchar',
    'type' => 'varchar',
    'len' => '50',
    'comment' => 'code of the product',
    'importable' => 'required',
    'required' => true,
    'studio' => 'visible',
);
$dictionary['ProductTemplate']['fields']['status2'] =
array(
    'name' => 'status2',
    'vname' => 'LBL_STATUS_2',
    'type' => 'enum',
    'options' => 'status_ProductTemplates_list',
    'len' => 100,
);
$dictionary['ProductTemplate']['fields']['unit'] =
array(
    'name' => 'unit',
    'vname' => 'LBL_UNIT',
    'type' => 'enum',
    'options' => 'unit_ProductTemplates_list',
    'len' => 100,
    'studio' => 'visible',
);
$dictionary['ProductTemplate']['fields']['inventorydetail_link'] =array(
    'name' => 'inventorydetail_link',
    'type' => 'link',
    'relationship' => 'book_inventorydetails',
    'module' => 'J_Inventorydetail',
    'bean_name' => 'J_Inventorydetail',
    'source' => 'non-db',
    'vname' => 'LBL_INVENTORYDETAIL',
);
$dictionary['ProductTemplate']['relationships']['book_inventorydetails'] = array(
    'lhs_module'        => 'ProductTemplates',
    'lhs_table'            => 'product_templates',
    'lhs_key'            => 'id',
    'rhs_module'        => 'J_Inventorydetail',
    'rhs_table'            => 'j_inventorydetail',
    'rhs_key'            => 'book_id',
    'relationship_type'    => 'one-to-many',
);

$dictionary['ProductTemplate']['fields']['is_allocation'] = array(
        'name' => 'is_allocation',
        'vname' => 'LBL_IS_ALLOCATION',
        'type' => 'bool',
        'studio' => 'visible',
    );

$dictionary["ProductTemplate"]["fields"]["product_discount"] = array(
    'name' => 'product_discount',
    'vname' => 'LBL_DISCOUNT_FOR_PRODUCT',
    'type' => 'varchar',
    'len' => '36',
    'default' => '',
    'query_type' => 'default',
    'source' => 'non-db',
    'studio' => array('searchview' => true, 'visible' => false),
);
// Add new field by nnamnguyen
$dictionary["ProductTemplate"]["fields"]["number_of_user"] = array(
    'name' => 'number_of_user',
    'vname' => 'LBL_NUMBER_OF_USER',
    'type' => 'int',
    'len' => 5,
);