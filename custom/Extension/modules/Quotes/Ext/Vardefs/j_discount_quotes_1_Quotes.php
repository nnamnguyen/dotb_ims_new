<?php
// created: 2020-11-03 17:19:57
$dictionary["Quote"]["fields"]["j_discount_quotes_1"] = array (
  'name' => 'j_discount_quotes_1',
  'type' => 'link',
  'relationship' => 'j_discount_quotes_1',
  'source' => 'non-db',
  'module' => 'J_Discount',
  'bean_name' => 'J_Discount',
  'vname' => 'LBL_J_DISCOUNT_QUOTES_1_FROM_J_DISCOUNT_TITLE',
  'id_name' => 'j_discount_quotes_1j_discount_ida',
);

$dictionary['Quote']['fields']['order_discount_amount'] =
    array(
        'name' => 'order_discount_amount',
        'vname' => 'LBL_ORDER_DISCOUNT_AMOUNT',
        'dbType' => 'decimal',
        'type' => 'currency',
        'len' => '26,6',
        'studio' => 'visible',
        'default'=> '0'
    );
$dictionary['Quote']['fields']['order_discount_percent'] =
    array(
        'name' => 'order_discount_percent',
        'vname' => 'LBL_ORDER_DISCOUNT_PERCENT',
        'dbType' => 'decimal',
        'type' => 'currency',
        'len' => '26,6',
        'studio' => 'visible',
        'default'=> '0'
    );
$dictionary['Quote']['fields']['order_sponsor_amount'] =
    array(
        'name' => 'order_sponsor_amount',
        'vname' => 'LBL_ORDER_SPONSOR_AMOUNT',
        'dbType' => 'decimal',
        'type' => 'currency',
        'len' => '26,6',
        'studio' => 'visible',
        'default'=> '0'
    );
$dictionary['Quote']['fields']['order_sponsor_percent'] =
    array(
        'name' => 'order_sponsor_percent',
        'vname' => 'LBL_ORDER_SPONSOR_PERCENT',
        'dbType' => 'decimal',
        'type' => 'currency',
        'len' => '26,6',
        'studio' => 'visible',
        'default'=> '0'
    );
$dictionary['Quote']['fields']['order_loyalty_amount'] =
    array(
        'name' => 'order_loyalty_amount',
        'vname' => 'LBL_ORDER_LOYALTY_AMOUNT',
        'dbType' => 'decimal',
        'type' => 'currency',
        'len' => '26,6',
        'studio' => 'visible',
        'default'=> '0'
    );
$dictionary['Quote']['fields']['order_loyalty_percent'] =
    array(
        'name' => 'order_loyalty_percent',
        'vname' => 'LBL_ORDER_LOYALTY_PERCENT',
        'dbType' => 'decimal',
        'type' => 'currency',
        'len' => '26,6',
        'studio' => 'visible',
        'default'=> '0'
    );

$dictionary['Quote']['fields']['quote_discount_detail'] =
    array(
        'name' => 'quote_discount_detail',
        'vname' => 'LBL_ORDER_DISCOUNT_DETAIL',
        'type' => 'text',
        'len' => '1000',
        'studio' => 'visible',
        'default'=> '0'
    );

$dictionary['Quote']['fields']['discount_detail'] =
    array(
        'name' => 'discount_detail',
        'type' => 'text',
        'len' => '1000',
        'studio' => 'visible',
        'default'=> '0',
        'source'    => 'non-db',
    );

$dictionary['Quote']['fields']['sponsor_detail'] =
    array(
        'name' => 'sponsor_detail',
        'type' => 'text',
        'len' => '1000',
        'studio' => 'visible',
        'default'=> '0',
        'source'    => 'non-db',
    );

$dictionary['Quote']['fields']['loyalty_detail'] =
    array(
        'name' => 'loyalty_detail',
        'type' => 'text',
        'len' => '1000',
        'studio' => 'visible',
        'default'=> '0',
        'source'    => 'non-db',
    );

