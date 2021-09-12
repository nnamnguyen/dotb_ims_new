<?php

$viewdefs['base']['view']['history-summary-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'picture',
            'type' => 'avatar',
            'size' => 'large',
            'dismiss_label' => true,
            'readonly' => true,
        ),
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_HISTORICAL_SUMMARY',
        ),
    ),
    'buttons' => array(
        array(
            'name'    => 'cancel_button',
            'type'    => 'button',
            'label'   => 'LBL_CLOSE_BUTTON_LABEL',
            'css_class' => 'btn-primary'
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
