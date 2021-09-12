<?php

$viewdefs['UserSignatures']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'name',
                    'link' => true,
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'is_default',
                    'type' => 'bool',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name'  => 'date_entered',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
