<?php

$viewdefs['Quotes']['base']['view']['panel-top-for-contracts'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',
    'buttons' => array(
        array(
            'type' => 'actiondropdown',
            'name' => 'panel_dropdown',
            'css_class' => 'pull-right',
            'buttons' => array(
                array(
                    'type' => 'sticky-rowaction',
                    'icon' => 'fa-plus',
                    'name' => 'create_button',
                    'dismiss_label' => true,
                    'label' => '',
                    'acl_action' => 'create',
                    'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                    'css_class' => 'disabled',
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
