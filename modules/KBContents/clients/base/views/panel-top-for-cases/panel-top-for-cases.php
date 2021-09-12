<?php


$viewdefs['KBContents']['base']['view']['panel-top-for-cases'] = array(
    'template' => 'panel-top',
    'type' => 'panel-top-for-cases',
    'buttons' => array(
        array(
            'type' => 'actiondropdown',
            'name' => 'panel_dropdown',
            'css_class' => 'pull-right',
            'buttons' => array(
                array(
                    'name' => 'create_button',
                    'type' => 'sticky-rowaction',
                    'icon' => 'fa-plus',
                    'label' => ' ',
                    'acl_module' => 'KBContents',
                    'acl_action' => 'create',
                    'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                ),
                array(
                    'type' => 'link-action',
                    'name' => 'select_button',
                    'label' => 'LBL_ASSOC_RELATED_RECORD',
                ),
            ),
        ),
    ),
);
