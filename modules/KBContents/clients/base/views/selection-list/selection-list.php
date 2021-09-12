<?php


$viewdefs['KBContents']['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'language',
                    'label' => 'LBL_LANG',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                    'type' => 'enum-config',
                    'key' => 'languages',
                ),
                array(
                    'name' => 'revision',
                    'label' => 'LBL_REVISION',
                    'enabled' => true,
                    'default' => false,
                    'readonly' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                    'enabled' => true,
                    'default' => true,
                    'type' => 'status',
                ),
                array(
                    'name' => 'viewcount',
                    'label' => 'LBL_VIEWED_COUNT',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'kbsapprover_name',
                    'label' => 'LBL_KBSAPPROVER',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_ASSIGNED_TO',
                    'default' => false,
                    'enabled' => true,
                ),
            ),
        ),
    ),
);
