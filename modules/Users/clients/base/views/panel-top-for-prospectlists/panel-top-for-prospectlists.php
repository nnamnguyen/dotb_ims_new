<?php


$viewdefs['Users']['base']['view']['panel-top-for-prospectlists'] = array(
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
                    'label' => ' ',
                    'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                    'acl_action' => 'create',
                    'css_class' => 'disabled',
                ),
                array(
                    'type' => 'link-action',
                    'name' => 'select_button',
                    'label' => 'LBL_ASSOC_RELATED_RECORD',
                ),
                array(
                    'type' => 'linkfromreportbutton',
                    'name' => 'select_button',
                    'label' => 'LBL_SELECT_REPORTS_BUTTON_LABEL',
                    'initial_filter' => 'by_module',
                    'initial_filter_label' => 'LBL_FILTER_USERS_REPORTS',
                    'filter_populate' => array(
                        'module' => array('Users'),
                    ),
                ),
            ),
        ),
    ),
);