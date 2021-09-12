<?php



$viewdefs['base']['view']['shortcuts-config-headerpane'] = array(
    'type' => 'list-headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_SHORTCUT_CONFIG_HEADERPANE',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'css_class' => 'btn-invisible btn-link',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name' => 'main_dropdown',
            'type' => 'actiondropdown',
            'primary' => true,
            'buttons' => array(
                array(
                    'name' => 'save_button',
                    'type' => 'rowaction',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'button:save_button:click',
                    ),
                ),
                array(
                    'name' => 'restore_button',
                    'type' => 'rowaction',
                    'label' => 'LBL_SHORTCUT_RESTORE',
                    'events' => array(
                        'click' => 'button:restore_button:click',
                    ),
                ),
            ),
        ),
    ),
);
