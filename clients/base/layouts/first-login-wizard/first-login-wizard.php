<?php


$viewdefs['base']['layout']['first-login-wizard'] = array(
    'type' => 'wizard',
    'buttons' => array(
        array(
            'name' => 'previous_button',
            'type' => 'button',
            'label' => 'LBL_BACK',
            'css_class' => 'btn-link btn-invisible',
        ),
        array(
            'name' => 'next_button',
            'type' => 'button',
            'label' => 'LNK_LIST_NEXT',
            'primary' => true,
        ),
        array(
            'name' => 'start_dotb_button',
            'type' => 'button',
            'label' => 'LBL_WIZ_START_DOTB',
            'primary' => true,
        ),
    ),
    'components' => array(
        array(
            'view' => 'user-wizard-page',
            'primary' => true,
        ),
        array(
            'view' => "user-locale-wizard-page",
        ),
        array(
            'view' => 'setup-complete-wizard-page',
        )
    ),
);
