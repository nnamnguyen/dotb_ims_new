<?php

$viewdefs['Users']['base']['view']['dupecheck-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'user_name',
                    'label' => 'LBL_USER_NAME',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'title',
                    'label' => 'LBL_TITLE',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'department',
                    'label' => 'LBL_DEPARTMENT',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'email',
                    'label' => 'LBL_EMAIL',
                    'enabled' => true,
                    'default' => false,
                    'sortable' => true,
                ),
                array(
                    'name' => 'phone_work',
                    'label' => 'LBL_OFFICE_PHONE',
                    'enabled' => true,
                    'default' => false,
                    'sortable' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                    'enabled' => true,
                    'default' => false,
                    'sortable' => true,
                ),
                array(
                    'name' => 'is_admin',
                    'label' => 'LBL_IS_ADMIN',
                    'enabled' => true,
                    'default' => false,
                    'sortable' => true,
                ),
            ),
        ),
    ),
);
