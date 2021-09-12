<?php


$viewdefs['pmse_Inbox']['base']['view']['casesList-headerpane'] = array(
    'template' => 'headerpane',
    'title' => "LBL_PMSE_TITLE_PROCESSESS_LIST",
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_PMSE_TITLE_PROCESSESS_LIST',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
