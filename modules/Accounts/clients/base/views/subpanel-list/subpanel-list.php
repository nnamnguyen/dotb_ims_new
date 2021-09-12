<?php

$viewdefs['Accounts']['base']['view']['subpanel-list'] = array(
  'panels' =>
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'default' => true,
          'label' => 'LBL_LIST_ACCOUNT_NAME',
          'enabled' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
          'default' => true,
          'label' => 'LBL_LIST_CITY',
          'enabled' => true,
          'name' => 'billing_address_city',
        ),
        array(
          'type' => 'varchar',
          'default' => true,
          'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
          'enabled' => true,
          'name' => 'billing_address_country',
        ),
        array(
          'default' => true,
          'label' => 'LBL_LIST_PHONE',
          'enabled' => true,
          'name' => 'phone_office',
        ),
      ),
    ),
  ),
);
