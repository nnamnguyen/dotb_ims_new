<?php


$viewdefs['Products']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PRODUCT',
			'tooltip' => 'LNK_NEW_PRODUCT',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Products',
            'route'=>'#Products/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_PRODUCTS',
			'tooltip' => 'LNK_IMPORT_PRODUCTS',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Products',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Products&return_module=Products&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
