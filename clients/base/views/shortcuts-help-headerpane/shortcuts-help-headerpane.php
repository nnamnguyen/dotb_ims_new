<?php



$viewdefs['base']['view']['shortcuts-help-headerpane'] = array(
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_KEYBOARD_SHORTCUTS_HELP_TITLE',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'configure_button',
            'type' => 'button',
            'label' => ' ',
            'icon' => 'fa-cog',
            'events' => array(
                'click' => 'button:configure_button:click',
            ),
        ),
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'primary' => true,
            'label' => 'LBL_CLOSE_BUTTON_LABEL',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
    ),
);
