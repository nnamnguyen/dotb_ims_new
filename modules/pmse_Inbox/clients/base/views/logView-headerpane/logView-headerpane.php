<?php


$module_name = 'pmse_Inbox';
$viewdefs[$module_name]['base']['view']['logView-headerpane'] = array(
    'template' => 'headerpane',
    'title' => 'LBL_PMSE_TITLE_LOG_VIEWER',
    'buttons' => array(
        array(
            'name'    => 'log_pmse_button',
            'type'    => 'button',
            'label'   => 'LBL_PMSE_BUTTON_REFRESH',
            'acl_action' => 'create',
            'css_class' => 'btn-primary',
        ),
        array(
            'name'    => 'log_clear_button',
            'type'    => 'button',
            'label'   => 'LBL_PMSE_BUTTON_CLEAR',
            'acl_action' => 'create',
            'css_class' => 'btn-primary',
        ),
    ),
);
