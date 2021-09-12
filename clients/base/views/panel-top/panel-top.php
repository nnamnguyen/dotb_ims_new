<?php


$viewdefs['base']['view']['panel-top'] = array(
    'buttons' => array(
        array(
           'type' => 'actiondropdown',
            'name' => 'panel_dropdown', 'notCustomButton' => true,
            'css_class' => 'pull-right',
            'notCustomButton' => true,
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
                    'type' => 'link-action',
                    'name' => 'select_button',
                    'label' => 'LBL_ASSOC_RELATED_RECORD',
                ),
            ),
        ),
    ),
    'fields' => array(
        array(
            'name' => 'collection-count',
            'type' => 'collection-count',
        ),
    ),
);
