<?php

$viewdefs['Leads']['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'type' => 'fullname',
                    'fields' => array(
                        'salutation',
                        'first_name',
                        'last_name',
                    ),
                    'link' => true,
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_LIST_STATUS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'account_name',
                    'label' => 'LBL_LIST_ACCOUNT_NAME',
                    'enabled' => true,
                    'default' => true,
                    'related_fields' => array(
                        'account_id',
                        'converted',
                    ),
                ),
                array(
                    'name' => 'phone_work',
                    'label' => 'LBL_LIST_PHONE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'email',
                    'label' => 'LBL_LIST_EMAIL_ADDRESS',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_USER',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => false,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
