<?php

$viewdefs['ReportSchedules']['base']['view']['list-headerpane'] = array(
    'buttons' => array(
        array(
            'name'    => 'create_button',
            'type'    => 'button',
            'label'   => 'LBL_CREATE_BUTTON_LABEL',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'events' => array(
                'click' => 'button:create_button:click',
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
