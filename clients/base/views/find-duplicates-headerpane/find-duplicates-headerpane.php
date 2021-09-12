<?php


$viewdefs['base']['view']['find-duplicates-headerpane'] = array(
    'template' => 'headerpane',
    'title' => 'LBL_POSIPLE_DUP',
    'buttons' => array(
        array(
            'name'    => 'cancel_button',
            'type'    => 'button',
            'label'   => 'LBL_GOBACK_BUTTON_LABEL',
            'css_class' => 'btn-warning',
        ),
        array(
            'name'    => 'merge_duplicates_button',
            'type'    => 'button',
            'label'   => 'LBL_MERGE_DUPLICATES',
            'css_class' => 'btn-primary disabled',
            'acl_action' => 'edit',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
