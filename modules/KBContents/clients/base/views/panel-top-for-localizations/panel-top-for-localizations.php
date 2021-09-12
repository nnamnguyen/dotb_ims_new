<?php

$viewdefs['KBContents']['base']['view']['panel-top-for-localizations'] = array(
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
                    'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                ),
                array(
                    // Replace `link-action` to disable click event when the `disabled` class is removed manually.
                    'type' => 'sticky-rowaction',
                    'name' => 'select_button',
                    'label' => 'LBL_ASSOC_RELATED_RECORD',
                    'css_class' => 'disabled',
                ),
            ),
        ),
    ),
);
