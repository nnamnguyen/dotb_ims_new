<?php
$dictionary["J_Discount"]["fields"]["product_discount"]= array(
    'name' => 'product_discount',
    'vname' => 'LBL_DISCOUNT_FOR_PRODUCT',
    'type' => 'int',
    'len' => '10',
    'default'=> '',
    'query_type' => 'default',
    'source' => 'non-db',
    'studio' => array('searchview'=>true,'visible'=>false),
);
// Add new field by nnamnguyen
$dictionary["J_Discount"]["fields"]["discount_code"]= array(
    'name' => 'discount_code',
    'vname' => 'LBL_DISCOUNT_CODE',
    'type' => 'varchar',
    'len'=> '20',
);
// Số tiền giảm tính theo %
$dictionary["J_Discount"]["fields"]["discount_percent_product"]= array(
    'name' => 'discount_percent_product',
    'vname' => 'LBL_DISCOUNT_PERCENT',
    'type' => 'int',
    'len' => 3,
);
// Số tiền giảm nhất định hay số tiền giảm giá tối đa theo phần trăm (%) => dựa theo discount unit: maximum_discount
$dictionary["J_Discount"]["fields"]["maximum_discount_amount"]= array(
    'name' => 'maximum_discount_amount',
    'vname' => 'LBL_MAXIMUM_DISCOUNT_AMOUNT',
    'type' => 'decimal',
    'len' => '26,6',
);
// Đơn vị tính giảm giá (% hoặc tiền mặt) => discount unit
$dictionary["J_Discount"]["fields"]["discount_unit"]= array(
    'name' => 'discount_unit',
    'vname' => 'LBL_DISCOUNT_UNIT',
    'type' => 'enum',
    'len'=> '10',
    'size' => '20',
    'options' => 'discount_unit_list',
);