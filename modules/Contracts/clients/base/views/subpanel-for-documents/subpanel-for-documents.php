<?php

$viewdefs['Contracts']['base']['view']['subpanel-for-documents'] = array(
  'type' => 'subpanel-list',
  'panels' =>
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'name' => 'name',
          'label' => 'LBL_LIST_NAME',
          'enabled' => true,
          'default' => true,
          'link' => true,
        ),
      ),
    ),
  ),
);
