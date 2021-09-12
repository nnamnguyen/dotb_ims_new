<?php
// created: 2020-10-22 16:59:00
$viewdefs['Products']['base']['view']['subpanel-for-j_discount-j_discount_products_1'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
        0 => 
        array (
          'label' => 'LBL_LIST_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => 'true',
        ),
        1 => 
        array (
          'name' => 'quote_name',
          'label' => 'LBL_QUOTE_NAME',
          'enabled' => true,
          'id' => 'QUOTE_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'unit_name',
          'label' => 'LBL_UNIT',
          'enabled' => true,
          'id' => 'UNIT_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        3 => 
        array (
          'label' => 'LBL_LIST_DISCOUNT_PRICE',
          'enabled' => true,
          'default' => true,
          'convertToBase' => true,
          'showTransactionalAmount' => true,
          'name' => 'discount_price',
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
          ),
        ),
        4 => 
        array (
          'name' => 'quantity',
          'label' => 'LBL_QUANTITY',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'total_amount',
          'label' => 'LBL_CALCULATED_LINE_ITEM_AMOUNT',
          'enabled' => true,
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
            2 => 'quantity',
            3 => 'discount_price',
            4 => 'discount_select',
            5 => 'discount_amount',
          ),
          'currency_format' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
      ),
    ),
  ),
  'type' => 'subpanel-list',
);