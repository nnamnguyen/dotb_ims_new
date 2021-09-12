<?php


$viewdefs['Manufacturers']['base']['view']['list-headerpane'] = array(

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


            'label' => 'LNK_NEW_PRODUCT_CATEGORY',
			'tooltip' => 'LNK_NEW_PRODUCT_CATEGORY',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#ProductCategories',
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


            'label' => 'LNK_IMPORT_MANUFACTURERS',
			'tooltip' => 'LNK_IMPORT_MANUFACTURERS',
            'acl_action' => '',
            'type' => 'button',
            'acl_module' => '',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Manufacturers&return_module=Manufacturers&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
