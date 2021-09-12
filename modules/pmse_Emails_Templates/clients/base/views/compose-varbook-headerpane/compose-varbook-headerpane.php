<?php


$viewdefs['pmse_Emails_Templates']['base']['view']['compose-varbook-headerpane'] = array(
    'template' => 'headerpane',
    'title'    => 'LBL_DOTB_FIELD_SELECTOR',
    'buttons'  => array(
        array(
            'name'      => 'cancel_button',
            'type'      => 'button',
            'label'     => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'name'      => 'done_button',
            'type'      => 'button',
            'label'     => 'LBL_DONE_BUTTON_LABEL',
            'css_class' => 'btn-primary',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
