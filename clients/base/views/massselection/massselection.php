<?php



$viewdefs['base']['view']['massselection'] = array(
    'buttons' => array(
        array(
            'type' => 'button',
            'value' => 'cancel',
            'css_class' => 'btn-link btn-invisible cancel_button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'primary' => false,
        ),
        array(
            'name' => 'select_button',
            'type' => 'button',
            'label' => 'LBL_SELECT_OPTION',
            'acl_action' => 'view',
            'css_class' => 'btn-primary',
            'primary' => true,
        ),
    ),
);
