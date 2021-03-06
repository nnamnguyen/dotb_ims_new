<?php

$viewdefs['Emails']['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'from_collection',
                    'type' => 'from',
                    'label' => 'LBL_LIST_FROM_ADDR',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                    'fields' => array(
                        'email_address_id',
                        'email_address',
                        'parent_type',
                        'parent_id',
                        'parent_name',
                        'invalid_email',
                        'opt_out',
                    ),
                ),
                array(
                    'name' => 'name',
                    'enabled' => true,
                    'default' => true,
                    'link' => 'true',
                    'related_fields' => array(
                        'total_attachments',
                        'state',
                    ),
                ),
                array(
                    'name' => 'state',
                    'label' => 'LBL_LIST_STATUS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_sent',
                    'label' => 'LBL_LIST_DATE_COLUMN',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'target_record_key' => 'assigned_user_id',
                    'target_module' => 'Employees',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'parent_name',
                    'link' => true,
                    'enabled' => true,
                    'default' => true,
                    'sortable' => false,
                ),
            ),
        ),
    ),
);
