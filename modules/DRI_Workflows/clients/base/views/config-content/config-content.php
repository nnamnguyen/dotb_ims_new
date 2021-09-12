<?php

$viewdefs['DRI_Workflows']['base']['view']['config-content'] = array (
    'fields' => array (
        array (
            'name' => 'license_key',
            'label' => 'LBL_LICENSE_KEY',
        ),
        array (
            'name' => 'validation_key',
            'type' => 'textarea',
            'rows' => '5',
            'label' => 'LBL_VALIDATION_KEY',
        ),
    ),
    'buttons' => array (
        array (
            'name' => 'close',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
            'events' => array (
                'click' => 'settings:close',
            ),
        ),
        array (
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'primary' => true,
            'events' => array (
                'click' => 'settings:save',
            ),
        ),
    ),
);
