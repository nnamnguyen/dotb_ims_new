<?php
$module_name = 'J_Voucher';
$viewdefs[$module_name] =
array (
  'base' =>
  array (
    'view' =>
    array (
      'list' =>
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
                  'type' => 'event-status'
              ),
              6 =>
              array (
                'name' => 'foc_type',
                'label' => 'LBL_FOC_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              7 =>
              array (
                'name' => 'use_time',
                'label' => 'LBL_USE_TIME',
                'enabled' => true,
                'default' => true,
                  'type' =>'match'
              ),
              8 =>
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              9 =>
              array (
                'name' => 'date_entered',
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
              11 =>
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
                12 =>
                    array (
                        'name' => 'used_time',
                        'enabled' => true,
                        'default' => false,
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
