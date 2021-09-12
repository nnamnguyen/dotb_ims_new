<?php


$viewdefs['base']['view']['headerpane'] = array(
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_MODULE_NAME',
        ),
    ),
    'buttons' => array(
        array(
            'name'    => 'create_button',
            'type'    => 'button',
            'label'   => 'LBL_CREATE_BUTTON_LABEL',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'route' => array(
                'action'=>'create'
            )
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
