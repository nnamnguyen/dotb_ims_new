<?php


    $viewdefs['Reports']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_MODULE_NAME',
        'buttons' => array(

            array(


                'label' => 'LBL_CREATE_REPORT',
                'tooltip' => 'LBL_CREATE_REPORT',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Reports',
                'route'=>'#bwc/index.php?module=Reports&report_module=&action=index&page=report&Create+Custom+Report=Create+Custom+Report',
                'icon' => 'fa-plus',
            ),

            array(


                'label' => 'LNK_REPORT_SCHEDULES',
                'tooltip' => 'LNK_REPORT_SCHEDULES',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'ReportSchedules',
                'route'=>'#ReportSchedules',
                'icon' => 'fa-clock',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
    );
