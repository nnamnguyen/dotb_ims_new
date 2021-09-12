<?php


$viewdefs['Contracts']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_CONTRACTS',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_CONTRACT',
			'tooltip' => 'LNK_NEW_CONTRACT',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Contracts',
            'route'=>'#Contracts/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_CONTRACTS',
			'tooltip' => 'LNK_IMPORT_CONTRACTS',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Contracts',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Contracts&return_module=Contracts&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);