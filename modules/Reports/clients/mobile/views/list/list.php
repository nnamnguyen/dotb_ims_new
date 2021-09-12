<?php

$viewdefs['Reports']['mobile']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'module',
                    'enabled' => true,
                    'default' => true,
                    'type' => 'enum',
                    'options' => 'moduleList',
                ),
                array(
                    'name' => 'team_name',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'report_type',
                    'enabled' => true,
                    'default' => true,
                    'type' => 'enum',
                    'options' => 'dom_report_types',
                ),
            ),
        ),
    ),
);
