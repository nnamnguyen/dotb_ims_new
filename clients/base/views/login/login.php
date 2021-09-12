<?php


$viewdefs['base']['view']['login'] = array(
    'action' => 'edit',
    'buttons' => array(
            array(
                'name' => 'login_button',
                'type' => 'button',
                'label' => 'LBL_LOGIN_BUTTON_LABEL',
                'primary' => true
            ),
        ),
    'panels' => array(
            array(
                'label' => 'LBL_PANEL_DEFAULT',
                'fields' =>
                array(
                    array(
                        'name' => 'username',
                        'type' => 'username',
                        'placeholder' => "LBL_LIST_USER_NAME", //LBL_LOGIN_USERNAME not translating properly across languages so using this for 6.x parity
                        'no_required_placeholder' => true,
                        'required' => true,
                    ),
                    array(
                        'name' => 'password',
                        'type' => 'password',
                        'placeholder' => "LBL_PASSWORD",
                        'no_required_placeholder' => true,
                        'required' => true,
                    ),
                ),
            ),
        ),
);
