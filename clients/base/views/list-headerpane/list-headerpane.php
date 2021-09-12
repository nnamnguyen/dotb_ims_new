<?php


    $viewdefs['base']['view']['list-headerpane'] = array(
        'fields' => array(
            array(
                'name' => 'title',
                'type' => 'label',
                'default_value' => 'LBL_MODULE_NAME',
            ),
            array(
                'name' => 'collection-count',
                'type' => 'collection-count',
            ),
        ),
        'buttons' => array(
            array(

                'type' => 'button',
                'label' => 'LBL_CREATE_BUTTON_LABEL',
                'tooltip' => 'LBL_CREATE_BUTTON_LABEL',

                'acl_action' => 'create',
                'route' => array(
                    'action' => 'create'
                ),
                'icon' => 'fa-plus',
            ),

            array(
                'name_button' => 'report_button',

                'label' => 'LBL_REPORT_BUTTON_LABEL',
                'tooltip' => 'LBL_REPORT_BUTTON_LABEL',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'Reports',
                'customRoute' => true,
                'icon' => 'fa-user-chart',
            ),

            array(
                'name_button'=>'import_button',
                'type' => 'button',
                'label' =>'LBL_IMPORT_BUTTON_LABEL',

                'acl_action'=>'import',
                'customRoute' => true,
                'icon' => 'fa-cloud-upload',
            ),
            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
);