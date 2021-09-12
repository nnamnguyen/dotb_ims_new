<?php


$viewdefs['Meetings']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_MEETING',
			'tooltip' => 'LNK_NEW_MEETING',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Meetings',
            'route'=>'#Meetings/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_MEETINGS',
			'tooltip' => 'LNK_IMPORT_MEETINGS',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Meetings',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Meetings&return_module=Meetings&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
