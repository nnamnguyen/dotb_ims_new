<?php
// created: 2018-10-15 09:49:10
$viewdefs['RevenueLineItems']['base']['view']['list'] = array (
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
          'name' => 'name',
          'link' => true,
          'label' => 'LBL_LIST_NAME',
          'enabled' => true,
          'default' => true,
        ),
        1 => 
        array (
          'name' => 'mft_part_num',
          'label' => 'LBL_MFT_PART_NUM',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'probability',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'likely_case',
          'type' => 'currency',
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
            2 => 'total_amount',
            3 => 'quantity',
            4 => 'discount_amount',
            5 => 'discount_price',
          ),
          'convertToBase' => true,
          'currency_field' => 'currency_id',
          'base_rate_field' => 'base_rate',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'date_closed',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'quantity',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'product_template_name',
          'enabled' => true,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'date_modified',
          'enabled' => true,
          'default' => false,
        ),
        8 => 
        array (
          'name' => 'assigned_user_name',
          'enabled' => true,
          'default' => false,
        ),
        9 => 
        array (
          'name' => 'account_name',
          'readonly' => true,
          'enabled' => true,
          'default' => false,
          'sortable' => true,
        ),
        10 => 
        array (
          'name' => 'commit_stage',
          'enabled' => true,
          'default' => false,
        ),
        11 => 
        array (
          'name' => 'worst_case',
          'type' => 'currency',
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
            2 => 'total_amount',
            3 => 'quantity',
            4 => 'discount_amount',
            5 => 'discount_price',
          ),
          'convertToBase' => true,
          'currency_field' => 'currency_id',
          'base_rate_field' => 'base_rate',
          'enabled' => true,
          'default' => false,
        ),
        12 => 
        array (
          'name' => 'best_case',
          'type' => 'currency',
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
            2 => 'total_amount',
            3 => 'quantity',
            4 => 'discount_amount',
            5 => 'discount_price',
          ),
          'convertToBase' => true,
          'currency_field' => 'currency_id',
          'base_rate_field' => 'base_rate',
          'enabled' => true,
          'default' => false,
        ),
        13 => 
        array (
          'name' => 'category_name',
          'enabled' => true,
          'default' => false,
        ),
        14 => 
        array (
          'name' => 'sales_stage',
          'enabled' => true,
          'default' => false,
        ),
        15 => 
        array (
          'name' => 'date_entered',
          'enabled' => true,
          'default' => false,
        ),
        16 => 
        array (
          'name' => 'opportunity_name',
          'enabled' => true,
          'default' => false,
          'sortable' => true,
        ),
        17 => 
        array (
          'name' => 'quote_name',
          'label' => 'LBL_ASSOCIATED_QUOTE',
          'related_fields' => 
          array (
            0 => 'quote_id',
          ),
          'readonly' => true,
          'enabled' => true,
          'default' => false,
        ),
      ),
    ),
  ),
);