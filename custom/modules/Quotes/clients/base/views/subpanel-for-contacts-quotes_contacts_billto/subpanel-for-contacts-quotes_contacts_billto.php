<?php
// created: 2020-08-04 22:40:15
$viewdefs['Quotes']['base']['view']['subpanel-for-contacts-quotes_contacts_billto'] = array (
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
          'default' => true,
          'enabled' => true,
        ),
        1 => 
        array (
          'name' => 'total',
          'default' => true,
          'enabled' => true,
        ),
        2 => 
        array (
          'name' => 'quote_stage',
          'default' => true,
          'enabled' => true,
          'type' => 'event-status',
        ),
        3 => 
        array (
          'name' => 'paid_amount',
          'label' => 'LBL_PAID_AMOUNT',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'unpaid_amount',
          'label' => 'LBL_UNPAID_AMOUNT',
          'css_class' => 'text_green',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'date_modified',
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
        ),
        7 => 'created_by_name',
        8 => 'date_modified',
      ),
    ),
  ),
  'rowactions' => 
  array (
    'actions' => 
    array (
    ),
  ),
  'orderBy' => 
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
);