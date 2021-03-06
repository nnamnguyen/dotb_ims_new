<?php

$viewdefs['Emails']['base']['view']['panel-top'] = array(
    'buttons' => array(
        array(
            'type' => 'actiondropdown',
            'name' => 'panel_dropdown',
            'css_class' => 'pull-right',
            'buttons' => array(
                array(
                    'type' => 'emailaction-paneltop',
                    'icon' => 'fa-plus',
                    'name' => 'email_compose_button',
                    'label' => ' ',
                    'acl_action' => 'create',
                    'set_recipient_to_parent' => true,
                    'set_related_to_parent' => true,
                    'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                ),
                array(
                    'type' => 'link-action',
                    'name' => 'select_button',
                    'label' => 'LBL_ASSOC_RELATED_RECORD',
                    'css_class' => 'disabled',
                ),
            ),
        ),
    ),
);
