<?php


$viewdefs['J_Discount']['base']['view']['list-headerpane'] = array(

    'buttons' => array(

        array(

            
            'label' => 'LNK_NEW_J_DISCOUNT',
			'tooltip' => 'LNK_NEW_J_DISCOUNT',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'J_Discount',
            'route'=>'#J_Discount/create',
            'icon' => 'fa-plus',
        ),
        array(

            
            'label' => 'LNK_J_DISCOUNT_REPORTS',
			'tooltip' => 'LNK_J_DISCOUNT_REPORTS',
            'acl_action' => 'list',
            'type' => 'button',
            'acl_module' => 'Reports',
            'route'=>'#Reports?filterModule=J_Discount',
            'icon' => 'fa-user-chart',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);