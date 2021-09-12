<?php

$viewdefs['KBContents']['base']['view']['config-languages'] = array(
    'label' => 'LBL_ADMIN_LABEL_LANGUAGES',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'languages',
                    'type' => 'languages',
                    'searchBarThreshold' => 5,
                    'label' => 'LBL_EDIT_LANGUAGES',
                    'default' => false,
                    'enabled' => true,
                    'view' => 'edit',
                    'span' => 6
                ),
            ),
        ),
    ),
);
