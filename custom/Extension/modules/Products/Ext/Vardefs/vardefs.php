<?php
$dictionary['Product']['fields']['unit_id'] = array(
    'name' => 'unit_id',
    'vname' => 'LBL_UNIT_ID',
    'type' => 'id',
    'required' => true,
    'reportable' => false,
    'comment' => ''
);
$dictionary['Product']['fields']['unit_name'] = array(
    'name' => 'unit_name',
    'rname' => 'name',
    'id_name' => 'unit_id',
    'vname' => 'LBL_UNIT',
    'type' => 'relate',
    'link' => 'unit_link',
    'table' => 'j_unit',
    'isnull' => 'true',
    'module' => 'J_Unit',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable' => true,
    'source' => 'non-db',
    'auto_populate' => true,
);
$dictionary['Product']['fields']['unit_link'] = array(
    'name' => 'unit_link',
    'type' => 'link',
    'relationship' => 'product_item_unit',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_UNIT',
    'id_name' => 'unit_id',
);
$dictionary['Product']['fields']['code'] = array(
    'name' => 'code',
    'vname' => 'LBL_CODE',
    'type' => 'varchar',
    'len' => 100,
    'studio' => 'visible',
);

$dictionary["Product"]["fields"]["product_discount"] = array(
    'name' => 'product_discount',
    'vname' => 'LBL_DISCOUNT_FOR_PRODUCT',
    'type' => 'varchar',
    'len' => '36',
    'default' => '',
    'query_type' => 'default',
    'source' => 'non-db',
    'studio' => array('searchview' => true, 'visible' => false),
);

$dictionary['Product']['fields']['group_unit_id'] = array(
    'name' => 'group_unit_id',
    'vname' => 'LBL_GROUP_UNIT_ID',
    'type' => 'varchar',
    'required' => true,
    'reportable' => false,
    'comment' => '',
    'len' => '36',
    'source' => 'non-db',
);

// Add new relationship 1-1 between Quoted line items and Discount by nnamnguyen
$dictionary['Product']['fields']['discount_id'] = array(
    'name' => 'discount_id',
    'vname' => 'LBL_DISCOUNT_ID',
    'type' => 'id',
    'required' => true,
    'reportable' => false,
    'comment' => ''
);
$dictionary['Product']['fields']['discount_name'] = array(
    'name' => 'discount_name',
    'rname' => 'name',
    'id_name' => 'discount_id',
    'vname' => 'LBL_DISCOUNT',
    'type' => 'relate',
    'link' => 'discount_link',
    'table' => 'j_discount',
    'isnull' => 'true',
    'module' => 'J_Discount',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable' => true,
    'source' => 'non-db',
    'auto_populate' => true,
);
$dictionary['Product']['fields']['discount_link'] = array(
    'name' => 'discount_link',
    'type' => 'link',
    'relationship' => 'product_item_discount',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_DISCOUNT',
    'id_name' => 'discount_id',
);