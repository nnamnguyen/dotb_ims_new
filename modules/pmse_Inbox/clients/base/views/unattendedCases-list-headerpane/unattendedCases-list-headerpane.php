<?php


$viewdefs['pmse_Inbox']['base']['view']['unattendedCases-list-headerpane'] = array(
    'template' => 'headerpane',
    'title' => 'LBL_PMSE_TITLE_UNATTENDED_CASES',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_PMSE_TITLE_UNATTENDED_CASES',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);