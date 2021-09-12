<?php

$module_name = 'Reports';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#bwc/index.php?module=Reports&report_module=&action=index&page=report&Create+Custom+Report=Create+Custom+Report',
        'label' =>'LBL_CREATE_REPORT',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#' . $module_name,
        'label' =>'LBL_ALL_REPORTS',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#ReportSchedules',
        'label' =>'LNK_REPORT_SCHEDULES',
        'acl_action'=>'list',
        'acl_module'=>'ReportSchedules',
        'icon' => 'fa-user-chart',
    ),
);
