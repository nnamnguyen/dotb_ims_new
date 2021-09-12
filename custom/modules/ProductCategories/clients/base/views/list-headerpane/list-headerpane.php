<?php


$viewdefs['ProductCategories']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PRODUCT',
			'tooltip' => 'LNK_NEW_PRODUCT',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#ProductTemplates/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_PRODUCT_LIST',
			'tooltip' => 'LNK_PRODUCT_LIST',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#ProductTemplates',
            'icon' => 'fa-list',
        ),
        array(


            'label' => 'LNK_NEW_MANUFACTURER',
			'tooltip' => 'LNK_NEW_MANUFACTURER',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#Manufacturers',
            'icon' => 'fa-list',
        ),
        array(


            'label' => 'LNK_NEW_PRODUCT_TYPE',
			'tooltip' => 'LNK_NEW_PRODUCT_TYPE',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#ProductTypes',
            'icon' => 'fa-list',
        ),
        array(


            'label' => 'LNK_IMPORT_PRODUCT_CATEGORIES',
			'tooltip' => 'LNK_IMPORT_PRODUCT_CATEGORIES',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=ProductCategories&return_module=ProductCategories&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
