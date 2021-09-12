<?php

$viewdefs['Leads']['base']['view']['dupecheck-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
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
                    'name' => 'email',
                    'label' => 'LBL_LIST_EMAIL_ADDRESS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'phone_mobile',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
