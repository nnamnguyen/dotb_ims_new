<?php
// created: 2018-10-15 09:49:10
$viewdefs['Quotes']['base']['view']['list'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
        1 => 
        array (
          'label' => 'LBL_LIST_QUOTE_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        2 =>
        array (
          'name'=>'parent_name'
        ),
          4 =>
              array (
                  'label' => 'LBL_STATUS',
                  'enabled' => true,
                  'default' => true,
                  'type' => 'event-status',
                  'name' => 'status',
              ),
        5 =>
        array (
          'label' => 'LBL_QUOTE_STAGE',
          'enabled' => true,
          'default' => true,
          'type' => 'event-status',
          'name' => 'quote_stage',
        ),
        6 =>
        array (
          'label' => 'LBL_TOTAL',
          'enabled' => true,
          'default' => true,
          'name' => 'total',
          'related_fields' => 
          array (
            0 => 'currency_id',
          ),
        ),
      7 =>
          array (
              'label' => 'LBL_PAID_AMOUNT',
              'enabled' => true,
              'default' => true,
              'name' => 'paid_amount',
              'related_fields' =>
                  array (
                      0 => 'currency_id',
                  ),
          ),
      8=>
          array (
              'label' => 'LBL_UNPAID_AMOUNT',
              'enabled' => true,
              'default' => true,
              'name' => 'unpaid_amount',
              'related_fields' =>
                  array (
                      0 => 'currency_id',
                  ),
          ),
        9 =>
        array (
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
          'enabled' => true,
          'default' => true,
          'sortable' => false,
        ),
        10 =>
        array (
          'name' => 'date_modified',
          'enabled' => true,
          'default' => true,
        ),
        11 =>
        array (
          'name' => 'modified_by_name',
          'label' => 'LBL_MODIFIED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'MODIFIED_USER_ID',
          'link' => true,
          'default' => false,
        ),
        12 =>
        array (
          'name' => 'discount',
          'label' => 'LBL_DISCOUNT_TOTAL',
          'enabled' => true,
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
          ),
          'currency_format' => true,
          'default' => false,
        ),
        13 =>
        array (
          'name' => 'tax',
          'label' => 'LBL_TAX',
          'enabled' => true,
          'related_fields' => 
          array (
            0 => 'currency_id',
            1 => 'base_rate',
            2 => 'taxrate_value',
            3 => 'taxable_subtotal',
          ),
          'currency_format' => true,
          'default' => false,
        ),
        14 =>
        array (
          'name' => 'shipping_address_country',
          'label' => 'LBL_SHIPPING_ADDRESS_COUNTRY',
          'enabled' => true,
          'default' => false,
        ),
        15 =>
        array (
          'name' => 'base_rate',
          'label' => 'LBL_CURRENCY_RATE',
          'enabled' => true,
          'sortable' => false,
          'default' => false,
        ),
        16 =>
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => false,
        ),
        17 =>
        array (
          'name' => 'date_entered',
          'enabled' => true,
          'default' => false,
        ),
      ),
    ),
  ),
);