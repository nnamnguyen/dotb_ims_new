<?php


$viewdefs['Quotes']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_QUOTE',
			'tooltip' => 'LNK_NEW_QUOTE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Quotes',
            'route'=>'#Quotes/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_QUOTE_REPORTS',
			'tooltip' => 'LNK_QUOTE_REPORTS',
            'acl_action' => 'list',
            'type' => 'button',
            'acl_module' => 'Reports',
            'route'=>'#Reports?filterModule=Quotes',
            'icon' => 'fa-user-chart',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
