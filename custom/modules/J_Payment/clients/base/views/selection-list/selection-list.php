<?php


$module_name = 'J_Payment';
$viewdefs[$module_name]['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
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
                    'name' => 'parent_name',
                    'enabled' => true,
                    'id' => 'PARENT_ID',
                    'link' => true,
                    'sortable' => false,
                    'default' => true,
                ),
                array (
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                    'enabled' => true,
                    'default' => true,
                    'type' => 'event-status'
                ),
                array (
                    'name' => 'payment_type',
                    'enabled' => true,
                    'default' => true,
                    'type' => 'event-status'
                ),
                array (
                    'name' => 'total_quantity',
                    'label' => 'LBL_TOTAL_QUANTITY',
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
    'orderBy' => array(
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
