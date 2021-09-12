<?php


$viewdefs['ContractTypes']['base']['view']['list'] = array(
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
                    'name' => 'list_order',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
