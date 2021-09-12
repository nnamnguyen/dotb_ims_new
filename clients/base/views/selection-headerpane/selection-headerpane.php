<?php


$viewdefs['base']['view']['selection-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_SEARCH_AND_SELECT',
        ),
        array(
            'name' => 'collection-count',
            'type' => 'collection-count',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'close',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'events' => array(
                'click' => 'selection:closedrawer:fire',
            ),
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'buttons' => array(
                array(
                    'name' => 'link_button',
                    'type' => 'link-button',
                    'label' => 'LBL_ADD_BUTTON',
                    'events' => array(
                        'click' => 'selection:link:fire',
                    ),
                ),
                array(
                    'name' => 'create_button',
                    'type' => 'rowaction',
                    'label' => 'LBL_CREATE_BUTTON_LABEL',
                    'acl_action' => 'create',
                ),
                array(
                    'name' => 'select_button',
                    'type' => 'button',
                    'label' => 'LBL_SELECT_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'selection:select:fire',
                    ),
                ),
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
