<?php


$viewdefs['TaxRates']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_SHIPPER',
			'tooltip' => 'LNK_NEW_SHIPPER',
            'acl_action' => 'admin',
            'type' => 'button',
            'acl_module' => 'Products',
            'route'=>'#Shippers',
            'icon' => 'fa-bars',
        ),
        array(


            'label' => 'LNK_NEW_TAXRATE',
			'tooltip' => 'LNK_NEW_TAXRATE',
            'acl_action' => 'admin',
            'type' => 'button',
            'acl_module' => 'Products',
            'route'=>'#TaxRates/create',
            'icon' => 'fa-bars',
        ),
        array(


            'label' => 'LNK_IMPORT_TAXRATES',
			'tooltip' => 'LNK_IMPORT_TAXRATES',
            'acl_action' => 'admin',
            'type' => 'button',
            'acl_module' => 'Products',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=TaxRates&return_module=TaxRates&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
