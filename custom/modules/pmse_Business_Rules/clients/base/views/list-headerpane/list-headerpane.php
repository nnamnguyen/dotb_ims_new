<?php


$viewdefs['pmse_Business_Rules']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PMSE_BUSINESS_RULES',
			'tooltip' => 'LNK_NEW_PMSE_BUSINESS_RULES',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'pmse_Business_Rules',
            'route'=>'#pmse_Business_Rules/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_PMSE_BUSINESS_RULES',
			'tooltip' => 'LNK_IMPORT_PMSE_BUSINESS_RULES',
            'acl_action' => 'upload',
            'type' => 'button',
            'acl_module' => 'pmse_Business_Rules',
            'route'=>'#pmse_Business_Rules/layout/businessrules-import',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
