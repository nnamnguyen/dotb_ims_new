<?php

    $moduleName = 'J_PaymentDetail';
    $viewdefs[$moduleName]['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_MODULE_NAME',
        'buttons' => array(
            array(
                'label' => 'LNK_NEW_RECORD',
                'tooltip' => 'LNK_NEW_RECORD',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'J_PaymentDetail',
                'route'=>'#J_PaymentDetail/create',
                'icon' => 'fa-plus',
            ),
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