<?php


$viewdefs['DRI_Workflow_Templates']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_DRI_WORKFLOW_TEMPLATES',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_RECORD',
			'tooltip' => 'LNK_NEW_RECORD',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'DRI_Workflow_Templates',
            'route'=>'#DRI_Workflow_Templates/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_IMPORT_CUSTOMER_JOURNEY_TEMPLATES',
			'tooltip' => 'LNK_IMPORT_CUSTOMER_JOURNEY_TEMPLATES',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'pmse_Inbox',
            'route'=>'#DRI_Workflow_Templates/layout/template-import',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);