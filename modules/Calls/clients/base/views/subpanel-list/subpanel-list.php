<?php

$viewdefs['Calls']['base']['view']['subpanel-list'] = array(
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
          'link' => true,
          'name' => 'name',
        ),
        array(
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
          'name' => 'status',
          'type' => 'event-status',
          'css_class' => 'full-width',
        ),
        array(
          'name' => 'date_start',
          'label' => 'LBL_LIST_DATE',
          'type' => 'datetimecombo-colorcoded',
          'completed_status_value' => 'Held',
          'enabled' => true,
          'default' => true,
          'css_class' => 'overflow-visible',
          'readonly' => true,
          'related_fields' => array('status'),
        ),
        array(
          'label' => 'LBL_DATE_END',
          'enabled' => true,
          'default' => true,
          'name' => 'date_end',
          'css_class' => 'overflow-visible',
        ),
        array(
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
  'rowactions' => array(
    'actions' => array(
      array(
        'type' => 'rowaction',
        'css_class' => 'btn',
        'tooltip' => 'LBL_PREVIEW',
        'event' => 'list:preview:fire',
        'icon' => 'fa-search-plus',
        'acl_action' => 'view',
      ),
      array(
          'type' => 'rowaction',
          'name' => 'edit_button',
          'icon' => 'fa-pencil',
          'label' => 'LBL_EDIT_BUTTON',
          'event' => 'list:editrow:fire','css_class'=>'btn',
          'acl_action' => 'edit',
      ),
      array(
        'type' => 'unlink-action',
        'icon' => 'fa-chain-broken',
        'tooltip' => 'LBL_UNLINK_BUTTON', 'css_class'=>'btn',
      ),
      array(
        'type' => 'closebutton',
        'icon' => 'fa-times-circle',
        'name' => 'record-close',
        'tooltip' => 'LBL_CLOSE_BUTTON_TITLE', 'css_class'=>'btn','icon'=>'fa-times-o', 'dismiss_label'=>true,
        'closed_status' => 'Held',
        'acl_action' => 'edit',
      ),
    ),
  ),
);
