<?php


$viewdefs['Tasks']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_TASK',
			'tooltip' => 'LNK_NEW_TASK',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Tasks',
            'route'=>'#Tasks/create',
            'icon' => 'fa-plus',
        ),

        array(


            'label' => 'LNK_IMPORT_TASKS',
			'tooltip' => 'LNK_IMPORT_TASKS',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Tasks',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Tasks&return_module=Tasks&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
