<?php

$viewdefs['DRI_Workflows']['base']['view']['list-headerpane'] = array(
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_MODULE_NAME',
        ),
        array(
            'name' => 'collection-count',
            'type' => 'collection-count',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
