<?php



$viewdefs['base']['view']['password-expired'] = array(
    'action' => 'list',
    'buttons' => array(
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'value' => 'save',
            'css_class' => 'btn-primary save-profile',
        ),
    ),
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'expired_password_update',
                    'type' => 'change-my-password',
                    'label' => 'LBL_CONTACT_EDIT_PASSWORD',
                    'displayParams' => array(
                        'colspan' => 2,
                    ),
                ),
            ),
            array(
                'name' => 'name_field',
                'type' => 'text',
                'css_class' => 'hp',
                'placeholder' => "LBL_HONEYPOT",
            ),
        ),
    ),
);
