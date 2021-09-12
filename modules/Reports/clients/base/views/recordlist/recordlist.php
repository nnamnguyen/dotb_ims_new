<?php

$viewdefs['Reports']['base']['view']['recordlist'] = array(
    'favorite' => true,
    'sticky_resizable_columns' => true,
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'massupdate_button',
                'type' => 'button',
                'label' => 'LBL_MASS_UPDATE',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massupdate:fire',
                ),
                'acl_action' => 'massupdate',
            ),
            array(
                'name' => 'calc_field_button',
                'type' => 'button',
                'label' => 'LBL_UPDATE_CALC_FIELDS',
                'events' => array(
                    'click' => 'list:updatecalcfields:fire',
                ),
                'acl_action' => 'massupdate',
            ),
            array(
                'name' => 'massdelete_button',
                'type' => 'button',
                'label' => 'LBL_DELETE',
                'acl_action' => 'delete',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massdelete:fire',
                ),
            ),
        ),
    ),
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
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
                 'tooltip' => 'LBL_EDIT_BUTTON',
'label' => 'LBL_EDIT_BUTTON',


                'icon' => 'fa-pencil',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'edit_report_button',
                'label' => 'LBL_EDIT_REPORT_BUTTON',
                'event' => 'list:editreport:fire',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'create_schedule_button',
                'label' => 'LBL_SCHEDULE_REPORT_BUTTON',
                'event' => 'list:schedulereport:fire',
                'acl_module' => 'ReportSchedules',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'view_schedules_button',
                'label' => 'LBL_VIEW_SCHEDULES_BUTTON',
                'event' => 'list:viewschedules:fire',
                'acl_module' => 'ReportSchedules',
                'acl_action' => 'list',
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
                'tooltip' => 'LBL_DELETE_BUTTON',
'label' => 'LBL_DELETE_BUTTON',


                'icon' => 'fa-trash-alt',
            ),
        ),
    ),
);
