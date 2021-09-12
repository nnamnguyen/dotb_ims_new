<?php

$module_name = 'J_PaymentDetail';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array(
  'panels' => 
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'default' => true,
          'name' => 'date_modified',
        ),
      ),
    ),
  ),
    'rowactions' =>
    array(
        'actions' =>
            array(
                1 =>
                    array(
                        'type' => 'btnexport',
                        'css_class' => 'btn',
                        'name' => 'export_receipt',
                        'tooltip' => 'LBL_EXPORT_RECEIPT',
                        'icon' => 'fa-file-export',
                        'dismiss_label' => true,
                        'acl_action' => 'edit',
                    ),
                array(
                    'type' => 'unlink-action',
                    'css_class' => 'btn',
                    'icon' => 'fa-chain-broken',
                    'dismiss_label' => true,
                    'tooltip' => 'LBL_UNLINK_BUTTON',
                ),
            ),
    ),
    'orderBy' => array(
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
