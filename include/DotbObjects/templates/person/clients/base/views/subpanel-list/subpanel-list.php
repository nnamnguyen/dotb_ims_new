<?php

$module_name = '<module_name>';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array(
  'panels' => array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => array(
        array (
          'name' => 'name',
          'type' => 'fullname',
          'fields' => array(
            'salutation',
            'first_name',
            'last_name',
          ),
          'link' => true,
          'label' => 'LBL_LIST_NAME',
          'enabled' => true,
          'default' => true,
        ),
        array(
          'name' => 'email',
          'label' => 'LBL_LIST_EMAIL',
          'enabled' => true,
          'default' => true,
          'sortable' => false,
        ),
        array(
          'name' => 'phone_work',
          'label' => 'LBL_LIST_PHONE',
          'enabled' => true,
          'default' => true,
        ),
      ),
    ),
  ),
);
