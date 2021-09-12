<?php


$viewdefs['base']['view']['vcard-import-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_IMPORT_VCARD',
        ),
    ),
    'buttons' => array(
        array(
            'name'    => 'vcard_cancel_button',
            'type'    => 'button',
            'label'   => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'acl_action' => 'create',
            'buttons' => array(
                array(
                    'name' => 'vcard_finish_button',
                    'type' => 'rowaction',
                    'label' => 'LBL_CREATE_BUTTON_LABEL',
                    'acl_action' => 'create',
                    'css_class' => 'btn-primary',
                    'events' => array(
                        'click' => 'vcard:import:finish',
                    ),
                ),
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
