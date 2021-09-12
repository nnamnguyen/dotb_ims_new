<?php
// created: 2020-11-09 10:19:37
$viewdefs['Quotes']['base']['view']['subpanel-for-accounts-quote_parent'] = array (
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
          'label' => 'LBL_LIST_QUOTE_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
          1 =>
              array (
                  'name' => 'total',
                  'label' => 'LBL_TOTAL',
                  'enabled' => true,
                  'currency_format' => true,
                  'default' => true,
              ),
          2 =>
              array (
                  'name' => 'unpaid_amount',
                  'label' => 'LBL_UNPAID_AMOUNT',
                  'enabled' => true,
                  'currency_format' => true,
                  'default' => true,
              ),
          3 =>
              array (
                  'name' => 'paid_amount',
                  'label' => 'LBL_PAID_AMOUNT',
                  'enabled' => true,
                  'currency_format' => true,
                  'default' => true,
              ),
        4 =>
        array (
          'name' => 'quote_stage',
          'label' => 'LBL_QUOTE_STAGE',
          'enabled' => true,
          'default' => true,
            'type' => 'event-status'
        ),
        5 =>
        array (
          'name' => 'order_stage',
          'label' => 'LBL_ORDER_STAGE',
          'enabled' => true,
          'default' => true,
            'type' => 'event-status'
        ),
        6 =>
        array (
          'name' => 'opportunity_name',
          'label' => 'LBL_OPPORTUNITY_NAME',
          'enabled' => true,
          'id' => 'OPPORTUNITY_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
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
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => true,
        ),
        9 => 
        array (
          'name' => 'description',
          'label' => 'LBL_DESCRIPTION',
          'enabled' => true,
          'sortable' => false,
          'default' => true,
        ),
        10 => 
        array (
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
          'enabled' => true,
          'default' => true,
          'sortable' => false,
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
                            'type' => 'fieldset',
                            'name' => 'main_dropdown',
                            'primary' => false,
                            'showOn' => 'view',
                            'fields' =>
                                array (
                                    0 =>
                                        array(
                                            'type' => 'paidbutton',
                                            'name' => 'paid_button',
                                            'label' => 'LBL_PAY',
                                            'icon' => 'fa-hand-holding-usd',
                                            'tooltip' => 'LBL_PAY',
                                            'acl_action' => 'edit',
                                            'event' => 'list:paidInvoice:fire',
                                            'css_class' => 'btn',
                                            'module' => 'J_PaymentDetail'
                                        ),
                                ),
                        ),
                ),
        ),
  'type' => 'subpanel-list',
);