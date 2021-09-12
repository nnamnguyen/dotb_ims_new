<?php

$viewdefs['base']['view']['audit-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_AUDIT_TITLE',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'close_button',
            'type' => 'button',
            'label' => 'LBL_CLOSE_BUTTON_TITLE',
            'css_class' => 'btn btn-primary',
        ),
    ),
);
