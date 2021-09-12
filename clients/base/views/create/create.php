<?php
$viewdefs['base']['view']['create'] = array(
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
            'name' => 'gobackduplicate_button',
            'type' => 'button',
            'label' => 'LBL_GOBACK_DUPLICATE',
            'tooltip' => 'LBL_GOBACK_DUPLICATE',
            'css_class' => 'btn-warning ',
            'icon' => 'fa-long-arrow-left',
            'showOn' => 'duplicate',
            'events' => array(
                'click' => 'button:gobackduplicate_button:click',
            ),
        ),
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
            'icon' => 'fa-save',
            'css_class' => '',
            'primary' => true,
            'showOn' => 'create',
            'events' => array(
                'click' => 'button:save_button:click',
            ),
        ),
//        array(
//            'name' => 'duplicate_button',
//            'type' => 'button',
//            'label' => 'LBL_IGNORE_DUPLICATE_AND_SAVE',
//            'primary' => true,
//            'showOn' => 'duplicate',
//            'events' => array(
//                'click' => 'button:save_button:click',
//            ),
//        ),
        array(
            'name' => 'select_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
            'icon' => 'fa-save',
            'css_class' => '',
            'primary' => true,
            'showOn' => 'select',
            'events' => array(
                'click' => 'button:save_button:click',
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
