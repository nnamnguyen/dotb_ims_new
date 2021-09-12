<?php
$viewdefs['C_AdminConfig']['base']['view']['change_module_icon'] = array(
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'icon' => 'fa-times',
            
            'events' => ["click" => "cancel_icon"]
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'save_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
                    'icon' => 'fa-save',
                    
                    'events' => ["click" => "save_icon"]
                ),
            ),
        ),
    ),
);