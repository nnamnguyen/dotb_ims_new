<?php



$viewdefs['pmse_Emails_Templates']['base']['view']['compose-dotblinks-headerpane'] = array(
    'template' => 'headerpane',
    'title' => 'LBL_DOTB_LINK_SELECTOR',
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
            'css_class' => 'btn-primary',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
