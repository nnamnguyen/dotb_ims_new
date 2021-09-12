<?php

$viewdefs['Quotes']['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'label' => 'LBL_LIST_QUOTE_NAME',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'name',
                    'link' => true,
                ),
                array(
                    'label' => 'LBL_RELATED_TO',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'parent_name',
                    'link' => true,
                ),
                array(
                    'label' => 'LBL_STATUS',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'status',
                    'type' => 'event-status'
                ),
                array(
                    'label' => 'LBL_QUOTE_STAGE',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'quote_stage',
                    'type' => 'event-status'
                ),
                array(
                    'label' => 'LBL_LIST_GRAND_TOTAL',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'total',
                ),
                array(
                    'label' => 'LBL_PAID_AMOUNT',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'paid_amount',
                ),
                array(
                    'label' => 'LBL_UNPAID_AMOUNT',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'unpaid_amount',
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'target_record_key' => 'assigned_user_id',
                    'target_module' => 'Employees',
                    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
                    'enabled' => true,
                    'default' => false,
                    'sortable' => false,
                ),
            ),
        ),
    ),
);
