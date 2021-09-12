<?php


    $viewdefs['J_Payment']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_MODULE_NAME',
        'buttons' => array(
            array(


                'label' => 'LNK_CREATE_PAYMENT',
                'tooltip' => 'LNK_CREATE_PAYMENT',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'J_Payment',
                'route' => "bwc/index.php?module=J_Payment&action=EditView&payment_type=Cashholder",
                'icon' => 'fa-plus',
            ),
//			            array(
//
//
//                'label' => 'LNK_CREATE_ENROLLMENT',
//                'tooltip' => 'LNK_CREATE_ENROLLMENT',
//                'acl_action' => 'create',
//                'type' => 'button',
//                'acl_module' => 'J_Payment',
//                'route' => "bwc/index.php?module=J_Payment&action=EditView&payment_type=Enrollment",
//                'icon' => 'fa-plus',
//            ),

            array(


                'label' => 'LNK_PAYMENT_REPORTS',
                'tooltip' => 'LNK_PAYMENT_REPORTS',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'Reports',
                'route'=>'#Reports?filterModule=J_Payment',
                'icon' => 'fa-user-chart',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
);