<?php

$viewdefs['Notes']['mobile']['view']['list'] = array(
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
                    'name' => 'date_modified',
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'filename',
                    'label' => 'LBL_FILENAME',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
