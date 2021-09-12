<?php


$viewdefs['pmse_Emails_Templates']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PMSE_EMAILS_TEMPLATES',
			'tooltip' => 'LNK_NEW_PMSE_EMAILS_TEMPLATES',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'pmse_Emails_Templates',
            'route'=>'#pmse_Emails_Templates/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_PMSE_EMAILS_TEMPLATES',
			'tooltip' => 'LNK_IMPORT_PMSE_EMAILS_TEMPLATES',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'pmse_Emails_Templates',
            'route'=>'#pmse_Emails_Templates/layout/emailtemplates-import',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
