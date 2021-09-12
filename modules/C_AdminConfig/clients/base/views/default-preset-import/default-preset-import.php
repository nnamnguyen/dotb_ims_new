<?php
$viewdefs['C_AdminConfig']['base']['view']['default-preset-import'] = array(
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'icon' => 'fa-times',
            
            'events' => ["click" => "cancel_config"]
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
                    
                    'events' => ["click" => "save_config"]
                ),
            ),
        ),
    ),
    "fields" => array(
        array(
            "name" => "default_mapping_lead",
            "type" => "text",
            "label" => "LBL_LEAD"
        ),
        array(
            "name" => "default_mapping_contact",
            "type" => "text",
            "label" => "LBL_CONTACT"
        ),
        array(
            "name" => "default_mapping_prospect",
            "type" => "text",
            "label" => "LBL_PROSPECT"
        )
    )
);