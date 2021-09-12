<?php

    $moduleName = 'J_Sponsor';
    $viewdefs[$moduleName]['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_MODULE_NAME',
        'buttons' => array(
            array(

                
                'label' => 'LBL_REPORT_BUTTON_LABEL',
                'tooltip' => 'LBL_REPORT_BUTTON_LABEL',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'Reports',
                'route'=>'#Reports?filterModule='.$moduleName,
                'icon' => 'fa-user-chart',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
);