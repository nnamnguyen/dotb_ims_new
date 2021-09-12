<?php


$viewdefs['portal']['view']['login'] = array(
    'action' => 'edit',
    'buttons' =>
        array(
            array(
                'name' => 'login_button',
                'type' => 'button',
                'label' => 'LBL_LOGIN_BUTTON_LABEL',
                'primary' => true,
            ),
            array(
                'name' => 'signup_button',
                'type' => 'button',
                'label' => 'LBL_SIGNUP_BUTTON_LABEL',
                'css_class' => 'pull-left',
            ),
        ),
    'panels' =>
        array(
            array(
                'label' => 'LBL_PANEL_DEFAULT',
                'fields' =>
                array(
                    array(
                        'name' => 'username',
                        'type' => 'username',
                        'placeholder' => "LBL_PORTAL_LOGIN_USERNAME",
                        'no_required_placeholder' => true,
                        'required' => true,
                    ),
                    array(
                        'name' => 'password',
                        'type' => 'password',
                        'placeholder' => "LBL_PORTAL_LOGIN_PASSWORD",
                        'no_required_placeholder' => true,
                        'required' => true,
                    ),
                ),
            ),
        ),
);
