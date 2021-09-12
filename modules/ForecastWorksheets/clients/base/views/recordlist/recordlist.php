<?php

$viewdefs['ForecastWorksheets']['base']['view']['recordlist'] = array(
    'css_class' => 'forecast-worksheet',
    'favorite' => false,
    'selection' => array(),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',

                'tooltip' => 'LBL_PREVIEW',

                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
             array(
                 'type' => 'rowaction',
                 'name' => 'edit_button',


                 'tooltip' => 'LBL_EDIT_BUTTON',
'label' => 'LBL_EDIT_BUTTON',
                 'icon' => 'fa-pencil',
                 'icon' => 'fa-pencil',
                 'label' => 'LBL_EDIT_BUTTON',
                 'event' => 'list:editrow:fire',
                 'acl_action' => 'edit',
             ),

            array(
                'type' => 'rowaction',
                'name' => 'delete_button',

                'icon' => 'fa-trash-alt',
                'tooltip' => 'LBL_DELETE_BUTTON',
'label' => 'LBL_DELETE_BUTTON',


                'event' => 'list:deleterow:fire',
                'label' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
            )

        ),
    ),
);
