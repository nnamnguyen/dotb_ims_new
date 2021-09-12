<?php

$viewdefs['CampaignLog']['base']['view']['panel-top'] = array(
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
                    'label' => ' ',
                    'acl_action' => 'create',
                    'css_class' => 'disabled',
                    'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                ),
                array(
                    'type' => 'sticky-rowaction',
                    'name' => 'select_button',
                    'label' => 'LBL_ASSOC_RELATED_RECORD',
                    'icon' => 'fa-pencil',
                    'css_class' => 'disabled',
                ),
            ),
        ),
    ),

);
