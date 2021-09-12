<?php


$viewdefs['Prospects']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PROSPECT',
			'tooltip' => 'LNK_NEW_PROSPECT',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Prospects',
            'route'=>'#Prospects/create',
            'icon' => 'fa-plus',
        ),

        array(


            'label' => 'LNK_IMPORT_VCARD',
			'tooltip' => 'LNK_IMPORT_VCARD',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Prospects',
            'route'=>'#Prospects/vcard-import',
            'icon' => 'fa-address-card',
        ),

        array(


            'label' => 'LNK_IMPORT_PROSPECTS',
			'tooltip' => 'LNK_IMPORT_PROSPECTS',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Prospects',
            'route'=>'bwc/index.php?module=Import&action=Step1&import_module=Prospects&return_module=Prospects&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
