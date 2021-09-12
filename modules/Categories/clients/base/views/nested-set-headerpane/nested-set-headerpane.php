<?php


$viewdefs['Categories']['base']['view']['nested-set-headerpane'] = array(
    'template' => 'headerpane',
    'buttons' => array(
        array(
            'name' => 'close',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'events' => array(
                'click' => 'selection:closedrawer:fire',
            ),
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'name' => 'add_node_button',
            'type' => 'button',
            'label' => 'LBL_CREATE_BUTTON_LABEL',
            'events' => array(
                'click' => 'click:add_node_button',
            ),
            'css_class' => 'btn-primary',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
