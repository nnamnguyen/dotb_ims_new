<?php
// created: 2020-11-05 15:24:06
$viewdefs['J_Discount']['base']['view']['subpanel-for-producttemplates-product_templates_discount'] = array (
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
  'rowactions' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'type' => 'fieldset',
        'name' => 'main_dropdown',
        'primary' => false,
        'showOn' => 'view',
        'fields' => 
        array (
          0 => 
          array (
            'type' => 'unlink-action',
            'icon' => 'fa-chain-broken',
            'tooltip' => 'LBL_UNLINK_BUTTON',
            'css_class' => 'btn',
            'name' => 'select_button',
            'label' => 'LBL_UNLINK_BUTTON',
          ),
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