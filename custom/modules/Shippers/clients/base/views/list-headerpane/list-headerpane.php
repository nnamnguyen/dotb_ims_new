<?php


$viewdefs['Shippers']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_SHIPPER',
			'tooltip' => 'LNK_NEW_SHIPPER',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#Shippers/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_NEW_TAXRATE',
			'tooltip' => 'LNK_NEW_TAXRATE',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#TaxRates/create',
            'icon' => 'fa-money',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
