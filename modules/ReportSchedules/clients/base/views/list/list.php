<?php

$viewdefs['ReportSchedules']['base']['view']['list'] = array(
    // TODO add more metadata
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'report_name',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'time_interval',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'active',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_start',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name' => 'date_modified',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name' => 'modified_by_name',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name' => 'date_entered',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name' => 'created_by_name',
                    'enabled' => true,
                    'default' => false,
                ),
            ),
        ),
    ),
);
