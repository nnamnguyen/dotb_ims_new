<?php

$viewdefs['Cases']['portal']['view']['dupecheck-list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'case_number',
                    'default' => true,
                    'enabled' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'name',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'priority',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'status',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'id' => 'ASSIGNED_USER_ID',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'default' => false,
                    'enabled' => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
