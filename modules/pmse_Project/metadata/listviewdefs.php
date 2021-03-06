<?php


$module_name = 'pmse_Project';
$listViewDefs[$module_name] =
    array (
        'name' =>
            array (
                'width' => '32',
                'label' => 'LBL_NAME',
                'default' => true,
                'link' => true,
            ),
        'prj_module' =>
            array (
                'type' => 'enum',
                'default' => true,
                'studio' => 'visible',
                'label' => 'LBL_PRJ_MODULE',
                'width' => '10',
            ),
        'prj_status' =>
            array (
                'type' => 'varchar',
                'default' => true,
                'label' => 'LBL_PRJ_STATUS',
                'width' => '10',
            ),
        'assigned_user_name' =>
            array (
                'width' => '9',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'module' => 'Employees',
                'id' => 'ASSIGNED_USER_ID',
                'default' => true,
            ),
        'team_name' =>
            array (
                'width' => '9',
                'label' => 'LBL_TEAM',
                'default' => false,
            ),
    );
