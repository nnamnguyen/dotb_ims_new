<?php


$viewdefs['pmse_Project']['base']['view']['create'] = array(
    'template' => 'record',
    'buttons' => array(
        array(
            'name'      => 'cancel_button',
            'type'      => 'button',
            'label'     => 'LBL_CANCEL_BUTTON_LABEL',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn ',
            'icon' => 'fa-times',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name'      => 'restore_button',
            'type'      => 'button',
            'label'     => 'LBL_RESTORE',
            'css_class' => 'btn-invisible btn-link',
            'showOn'    => 'select',
            'events' => array(
                'click' => 'button:restore_button:click',
            ),
        ),
        array(
            'type'    => 'actiondropdown',
            'name'    => 'main_dropdown',
            'primary' => true,
            'switch_on_click' => true,
            'showOn' => 'create',
            'buttons' => array(
                array(
                    'type'   => 'rowaction',
                    'name'   => 'save_open_design',
                    'label'  => 'LBL_PMSE_SAVE_DESIGN_BUTTON_LABEL',
                    'tooltip'  => 'LBL_PMSE_SAVE_DESIGN_BUTTON_LABEL',
                    
                    'icon' => 'fa-drafting-compass',
                    'events' => array(
                        'click' => 'button:save_open_design:click',
                    ),
                ),
                array(
                    'type'  => 'rowaction',
                    'name'  => 'save_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
                    
                    'icon' => 'fa-save',
                    'events' => array(
                        'click' => 'button:save_button:click',
                    ),
                ),
            ),
        ),
        // @TODO: Remove this entire array, and reset the showOn property in the
        // above array to ['create', 'select'] once SC implements support for
        // array values in showOn, scheduled for SC-5667.
        array(
            'type'    => 'actiondropdown',
            'name'    => 'dupecheck_dropdown',
            'primary' => true,
            'switch_on_click' => true,
            'showOn' => 'select',
            'buttons' => array(
                array(
                    'type'   => 'rowaction',
                    'name'   => 'save_open_design',
                    'label'  => 'LBL_PMSE_SAVE_DESIGN_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'button:save_open_design:click',
                    ),
                ),
                array(
                    'type'  => 'rowaction',
                    'name'  => 'save_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'button:save_button:click',
                    ),
                ),
            ),
        ),
        array(
            'name' => 'duplicate_button',
            'type' => 'button',
            'label' => 'LBL_IGNORE_DUPLICATE_AND_SAVE',
            'primary' => true,
            'showOn' => 'duplicate',
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
