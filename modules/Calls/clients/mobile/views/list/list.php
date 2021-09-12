<?php

$viewdefs['Calls']['mobile']['view']['list'] = array(
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
                    'name' => 'date_start',
                    'label' => 'LBL_DATE',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
