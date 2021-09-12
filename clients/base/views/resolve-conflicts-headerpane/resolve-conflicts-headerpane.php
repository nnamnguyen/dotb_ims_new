<?php



$viewdefs['base']['view']['resolve-conflicts-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_RESOLVE_CONFLICT',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'name' => 'select_button',
            'type' => 'button',
            'label' => 'LBL_SELECT_BUTTON_LABEL',
            'css_class' => 'btn-primary disabled',
            'acl_action' => 'edit',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
