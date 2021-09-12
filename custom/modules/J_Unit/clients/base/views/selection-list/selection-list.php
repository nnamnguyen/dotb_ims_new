<?php

$viewdefs['J_Unit']['base']['view']['selection-list'] = array(
    'favorites' => false,
    'panels' => array(
        array(
            'name' => 'panel_header',
            'fields' => array(
                array(
                    'name' => 'name',
                    'link' => true,
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'group_unit_name',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'quantity',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'base_unit_name',
                    'link' => 'true',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'quantity_base_unit',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'is_primary',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
