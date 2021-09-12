<?php
$module_name = 'J_Voucher';
$viewdefs[$module_name] =
array (
  'base' =>
  array (
    'view' =>
    array (
      'selection-list' =>
      array (
        'panels' =>
        array (
          0 =>
          array (
            'label' => 'LBL_PANEL_1',
            'fields' =>
            array (
              0 =>
              array (
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              1 =>
              array (
                'name' => 'discount_amount',
                'label' => 'LBL_DISCOUNT_AMOUNT',
                'enabled' => true,
                'currency_format' => true,
                'default' => true,
              ),
              2 =>
              array (
                'name' => 'discount_percent',
                'label' => 'LBL_DISCOUNT_PERCENT',
                'enabled' => true,
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'start_date',
                'label' => 'LBL_START_DATE',
                'enabled' => true,
                'default' => true,
              ),
              4 =>
              array (
                'name' => 'end_date',
                'label' => 'LBL_END_DATE',
                'enabled' => true,
                'default' => true,
              ),
              5 =>
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => true,
              ),
              array(
                  'name' => 'foc_type'
              ),
              array (
                'name' => 'use_time',
                'label' => 'LBL_USE_TIME',
                'enabled' => true,
                'default' => true,
              ),
              10 =>
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => true,
                'enabled' => true,
              ),
            ),
          ),
        ),
        'orderBy' =>
        array (
          'field' => 'date_modified',
          'direction' => 'desc',
        ),
      ),
    ),
  ),
);
