<?php
// created: 2020-10-24 16:55:57
$viewdefs['J_Payment']['base']['view']['subpanel-for-quotes-quotes_j_payment_1'] = array (
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
          array(
              'name'=>'payment_type',
              'type'=>'event-status'),
          array(
              'name'=>'payment_amount',
              'label' => 'LBL_TOTAL_AMOUNT'),
          array(
              'name'=>'total_amount_relata_balance',
              'type' => 'currency',
              'label' => 'LBL_USE_BALANCE_FOR_ORDER'
          ),
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
                            'type' => 'actiondropdown',
                            'name' => 'main_dropdown',
                            'primary' => false,
                            'showOn' => 'view',
                            'buttons' =>
                                array (
                                    0=> array (
                                        'type' => 'rowaction',
                                        'name' => 'void',
                                        'label' => 'LBL_VOID',
                                        'acl_action' => 'view',
                                        'event' => 'list:voidBalance:fire',
                                        'css_class' => 'btn',
                                        'icon' => 'fa-minus-circle',
                                        'primary' => false,
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