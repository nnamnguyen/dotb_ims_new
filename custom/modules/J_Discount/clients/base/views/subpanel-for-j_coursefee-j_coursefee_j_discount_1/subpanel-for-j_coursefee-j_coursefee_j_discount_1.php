<?php
// created: 2020-08-24 10:06:03
$viewdefs['J_Discount']['base']['view']['subpanel-for-j_coursefee-j_coursefee_j_discount_1'] = array (
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
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        1 => 
        array (
          'name' => 'type',
          'label' => 'LBL_TYPE',
          'enabled' => true,
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
          'name' => 'discount_amount',
          'label' => 'LBL_DISCOUNT_AMOUNT',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'start_date',
          'label' => 'LBL_START_DATE',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'end_date',
          'label' => 'LBL_END_DATE',
          'enabled' => true,
          'default' => true,
        ),
        7 => 
        array (
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'default' => true,
          'name' => 'date_modified',
        ),
      ),
    ),
  ),
  'orderBy' => 
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
);