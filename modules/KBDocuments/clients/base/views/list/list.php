<?php

$viewdefs['KBDocuments']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name'   => 'panel_header',
            'label'  => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'label'   => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                    'link'    => true,
                    'name'    => 'name',
                ),
                array(
                    'label'   => 'LBL_STATUS',
                    'enabled' => true,
                    'default' => true,
                    'name'    => 'status',
                ),
                array(
                    'name'              => 'assigned_user_name',
                    'target_record_key' => 'assigned_user_id',
                    'target_module'     => 'Employees',
                    'label'             => 'LBL_ASSIGNED_TO_NAME',
                    'enabled'           => true,
                    'default'           => true,
                    'sortable'          => false,
                ),
            ),
        ),
    ),
);
