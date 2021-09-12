<?php

$viewdefs['Emails']['base']['view']['subpanel-for-queues'] = array(
  'type' => 'subpanel-list',
  'panels' =>
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'label' => 'LBL_LIST_SUBJECT',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
        ),
        array(
          'target_record_key' => 'case_id',
          'target_module' => 'Cases',
          'label' => 'LBL_LIST_CASE',
          'enabled' => true,
          'default' => true,
          'name' => 'case_name',
        ),
        array(
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'default' => true,
          'name' => 'date_modified',
          'readonly' => true
        ),
      ),
    ),
  ),
);
