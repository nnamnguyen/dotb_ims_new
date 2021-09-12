<?php
// created: 2020-11-12 16:24:50
$viewdefs['J_Payment']['base']['view']['subpanel-for-c_sitedeployment-payment_sitedeployment'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
          array (
              'label' => 'LBL_NAME',
              'enabled' => true,
              'default' => true,
              'name' => 'name',
              'link' => true,
          ),
          array (
              'name' => 'product_name',
              'label' => 'LBL_PRODUCT_NAME',
              'enabled' => true,
              'id' => 'PRODUCT_ID',
              'link' => true,
              'sortable' => false,
              'default' => true,
          ),
          array (
              'name' => 'status',
              'label' => 'LBL_STATUS',
              'enabled' => true,
              'default' => true,
          ),
          array (
              'name' => 'order_name',
              'label' => 'LBL_ORDER_NAME',
              'enabled' => true,
              'default' => true,
          ),
          array (
              'name' => 'total_quantity',
              'label' => 'LBL_TOTAL_QUANTITY',
              'enabled' => true,
              'currency_format' => true,
              'default' => true,
          ),
          array (
              'name' => 'limit_quantity',
              'label' => 'LBL_LIMIT_QUANTITY',
              'enabled' => true,
              'currency_format' => true,
              'default' => true,
          ),
          array (
              'name' => 'unit_name',
              'label' => 'LBL_UNIT',
              'enabled' => true,
              'id' => 'UNIT_ID',
              'link' => true,
              'sortable' => false,
              'default' => true,
          ),
          array (
              'name' => 'date_active',
              'label' => 'LBL_DATE_ACTIVE',
              'enabled' => true,
              'default' => true,
          ),
          array (
              'name' => 'payment_expired',
              'label' => 'LBL_PAYMENT_EXPIRED',
              'enabled' => true,
              'default' => true,
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
  'orderBy' => 
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
);