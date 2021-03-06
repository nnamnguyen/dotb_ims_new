<?php


$viewdefs['Home']['base']['view']['top-activity-user'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_MOST_ACTIVE_COLLEAGUES',
            'description' => 'LBL_MOST_ACTIVE_COLLEAGUES_DESC',
            'config' => array(
                'filter_duration' => '7',
                'module' => 'Home'
            ),
            'preview' => array(
                'filter_duration' => '7',
                'module' => 'Home'
            ),
            'filter' => array(
                'module' => array(
                    'Home',
                ),
                'view' => 'record',
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_body',
            'columns' => 1,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'filter_duration',
                    'label' => 'Filter',
                    'type' => 'enum',
                    'options' => 'activity_user_options'
                ),
            ),
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'filter_duration',
            'label' => 'Filter',
            'type' => 'enum',
            'options' => 'activity_user_options'
        ),
    ),
);
