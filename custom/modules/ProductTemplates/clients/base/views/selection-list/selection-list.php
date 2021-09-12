<?php
$viewdefs['ProductTemplates'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'selection-list' => 
      array (
        'favorites' => false,
        'panels' => 
        array (
          0 => 
          array (
            'name' => 'panel_header',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'code',
                'label' => 'LBL_CODE',
                'enabled' => true,
                'default' => true,
              ),
              1 => 
              array (
                'name' => 'name',
                'link' => true,
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'list_price',
                'type' => 'currency',
                'related_fields' => 
                array (
                  0 => 'list_usdollar',
                  1 => 'currency_id',
                  2 => 'base_rate',
                ),
                'currency_field' => 'currency_id',
                'base_rate_field' => 'base_rate',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'unit_name',
                'label' => 'LBL_UNIT',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'type_name',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'status2',
                'label' => 'LBL_STATUS_2',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'date_available',
                'label' => 'LBL_DATE_AVAILABLE',
                'enabled' => true,
                'default' => true,
              ),
              7 => 
              array (
                'name' => 'status',
                'enabled' => true,
                'default' => true,
              ),
              8 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
              ),
              9 => 
              array (
                'name' => 'qty_in_stock',
                'enabled' => true,
                'default' => false,
              ),
              10 => 
              array (
                'name' => 'cost_price',
                'type' => 'currency',
                'related_fields' => 
                array (
                  0 => 'cost_usdollar',
                  1 => 'currency_id',
                  2 => 'base_rate',
                ),
                'currency_field' => 'currency_id',
                'base_rate_field' => 'base_rate',
                'enabled' => true,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'category_name',
                'enabled' => true,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'discount_price',
                'type' => 'currency',
                'related_fields' => 
                array (
                  0 => 'discount_usdollar',
                  1 => 'currency_id',
                  2 => 'base_rate',
                ),
                'currency_field' => 'currency_id',
                'base_rate_field' => 'base_rate',
                'enabled' => true,
                'default' => false,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
