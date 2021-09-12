<?php


$viewdefs['J_Voucher']['base']['view']['list-headerpane'] = array(

    'buttons' => array(

        array(

            
            'label' => 'LNK_NEW_J_VOUCHER',
			'tooltip' => 'LNK_NEW_J_VOUCHER',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'J_Voucher',
            'route'=>'#J_Voucher/create',
            'icon' => 'fa-plus',
        ),
        array(

            
            'label' => 'LNK_J_VOUCHER_REPORTS',
			'tooltip' => 'LNK_J_VOUCHER_REPORTS',
            'acl_action' => 'list',
            'type' => 'button',
            'acl_module' => 'Reports',
            'route'=>'#Reports?filterModule=J_Voucher',
            'icon' => 'fa-user-chart',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);