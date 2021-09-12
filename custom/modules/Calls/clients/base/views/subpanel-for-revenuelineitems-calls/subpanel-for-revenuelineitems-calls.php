<?php
// created: 2018-04-26 13:04:12
$viewdefs['Calls']['base']['view']['subpanel-for-revenuelineitems-calls'] = array(
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
          'label' => 'LBL_LIST_SUBJECT',
          'enabled' => true,
          'default' => true,
          'link' => true,
          'name' => 'name',
        ),
        1 =>
        array (
          'name' => 'description',
          'label' => 'LBL_DESCRIPTION',
          'enabled' => true,
          'sortable' => false,
          'default' => true,
          'width' => 'xxlarge',
        ),
        2 =>
        array (
          'name' => 'date_start',
          'label' => 'LBL_LIST_DATE',
          'type' => 'datetimecombo-colorcoded',
          'completed_status_value' => 'Held',
          'enabled' => true,
          'default' => true,
          'css_class' => 'overflow-visible',
          'readonly' => true,
          'related_fields' =>
          array (
            0 => 'status',
          ),
        ),
        3 =>
        array (
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
          'name' => 'status',
          'type' => 'event-status',
          'css_class' => 'full-width',
          'width' => 'small',
        ),
        4 =>
        array (
          'name' => 'call_result',
          'label' => 'LBL_CALL_RESULT',
          'enabled' => true,
          'default' => true,
        ),
        5 =>
        array (
          'name' => 'call_recording',
          'label' => 'LBL_CALL_RECORDING',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
            'type'=>'audio'
        ),
        6 =>
        array (
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
          'enabled' => true,
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
      1 =>
      array (
        'type' => 'rowaction',
        'label' => 'LBL_EDIT_BUTTON',
        'event' => 'list:editrow:fire',
        'icon' => 'fa-pencil',
        'acl_action' => 'edit',
      ),
    ),
  ),
  'type' => 'subpanel-list',
);