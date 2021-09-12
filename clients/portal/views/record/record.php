<?php
//FILE DOTBCRM flav=ent


$viewdefs['portal']['view']['record'] = array(
    'buttons' => array(
        array(
            'type' => 'button',
                                                'name' => 'cancel_button',
                                                'label' => 'LBL_CANCEL_BUTTON_LABEL',
                                                'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
                                                'css_class' => 'btn ',
                                                'icon' => 'fa-window-close',
                                                'showOn' => 'edit',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'type' => 'rowaction',
            'event' => 'button:save_button:click',
            'name' => 'save_button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
                                                'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
                                                'icon' => 'fa-save',
                                                
            'css_class' => 'btn btn-primary',
            'showOn' => 'edit',
            'acl_action' => 'edit',
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'showOn' => 'view',
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'event' => 'button:edit_button:click',
                    'name' => 'edit_button',
                    'tooltip' => 'LBL_EDIT_BUTTON_LABEL',
                                                                'label' => 'LBL_EDIT_BUTTON_LABEL',
                                                                'icon' => 'fa-pencil',
                                                                
                    'acl_action' => 'edit',
                ),
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
