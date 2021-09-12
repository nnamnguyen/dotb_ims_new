<?php
// created: 2021-03-22 16:30:16
$viewdefs['C_SMS']['base']['view']['subpanel-for-n_test-n_test_sms'] = array (
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
          'name' => 'phone_number',
          'label' => 'LBL_PHONE_NUMBER',
          'enabled' => true,
          'default' => true,
        ),
        1 => 
        array (
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        2 => 
        array (
          'label' => 'LBL_DATE_SEND',
          'enabled' => true,
          'default' => true,
          'name' => 'date_send',
        ),
        3 => 
        array (
          'label' => 'LBL_DELIVERY_STATUS',
          'enabled' => true,
          'default' => true,
          'name' => 'delivery_status',
        ),
        4 => 
        array (
          'label' => 'LBL_LIST_RELATED_TO',
          'enabled' => true,
          'default' => true,
          'name' => 'parent_name',
        ),
        5 => 
        array (
          'label' => 'LBL_SUPPLIER',
          'enabled' => true,
          'default' => true,
          'name' => 'supplier',
        ),
        6 => 
        array (
          'label' => 'LBL_DESCRIPTION',
          'enabled' => true,
          'default' => true,
          'name' => 'description',
        ),
        7 => 
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'date_modified',
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
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
        'type' => 'rowaction',
        'css_class' => 'btn',
        'tooltip' => 'LBL_PREVIEW',
        'event' => 'list:preview:fire',
        'icon' => 'fa-search-plus',
        'acl_action' => 'view',
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