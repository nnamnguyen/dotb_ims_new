<?php

$viewdefs['ProjectTask']['base']['view']['list'] = array(
    'panels' =>
        array(
            array(
                'name' => 'panel_header',
                'label' => 'LBL_PANEL_1',
                'fields' =>
                    array(
                        array(
                            'label' => 'LBL_LIST_NAME',
                            'enabled' => true,
                            'default' => true,
                            'readonly' => true,
                            'name' => 'name',
                            'link' => true
                        ),
                        array(
                            'label' => 'LBL_PROJECT_NAME',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'project_name',
                            'id' => 'project_id',
                            'link' => true
                        ),
                        array(
                            'label' => 'LBL_DATE_START',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'date_start',
                        ),
                        array(
                            'label' => 'LBL_DATE_FINISH',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'date_finish',
                        ),
                        array(
                            'label' => 'LBL_LIST_PRIORITY',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'priority',
                        ),
                        array(
                            'label' => 'LBL_LIST_PERCENT_COMPLETE',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'percent_complete',
                        ),
                        array(
                            'name' => 'assigned_user_name',
                            'target_record_key' => 'assigned_user_id',
                            'target_module' => 'Employees',
                            'label' => 'LBL_ASSIGNED_TO_NAME',
                            'enabled' => true,
                            'default' => true,
                        )
                    ),
            ),
        ),
);
