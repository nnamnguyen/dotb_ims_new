<?php


$viewdefs['pmse_Project']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PMSE_PROJECT',
			'tooltip' => 'LNK_NEW_PMSE_PROJECT',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'pmse_Project',
            'route'=>'#pmse_Project/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_PMSE_PROJECT',
			'tooltip' => 'LNK_IMPORT_PMSE_PROJECT',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'pmse_Project',
            'route'=>'#pmse_Project/layout/project-import',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
