<?php


$viewdefs['KBContents']['base']['view']['create'] = array(
    'template' => 'record',
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn ',
            'icon' => 'fa-window-close',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name' => 'restore_button',
            'type' => 'button',
            'label' => 'LBL_RESTORE',
            'tooltip' => 'LBL_RESTORE',
            'css_class' => 'btn ',
            'icon' => 'fa-undo',
            'showOn' => 'select',
            'events' => array(
                'click' => 'button:restore_button:click',
            ),
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'switch_on_click' => true,
            'showOn' => 'create',
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'save_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'button:save_button:click',
                    ),
                ),
            ),
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'duplicate_dropdown',
            'primary' => true,
            'showOn' => 'duplicate',
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'duplicate_button',
                    'label' => 'LBL_IGNORE_DUPLICATE_AND_SAVE',
                    'events' => array(
                        'click' => 'button:save_button:click',
                    ),
                ),
            ),
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'select_dropdown',
            'primary' => true,
            'showOn' => 'select',
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'select_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'button:save_button:click',
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
