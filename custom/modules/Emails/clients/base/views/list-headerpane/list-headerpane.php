<?php


$viewdefs['Emails']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_EMAILS',
    'buttons' => array(

        array(


            'label' => 'LBL_COMPOSE_MODULE_NAME_SINGULAR',
			'tooltip' => 'LBL_COMPOSE_MODULE_NAME_SINGULAR',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Emails',
            'route'=>'#Emails/compose',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LBL_CREATE_ARCHIVED_EMAIL',
			'tooltip' => 'LBL_CREATE_ARCHIVED_EMAIL',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Emails',
            'route'=>'#Emails/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_NEW_EMAIL_TEMPLATE',
			'tooltip' => 'LNK_NEW_EMAIL_TEMPLATE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'EmailTemplates',
            'route'=>'#bwc/index.php?module=EmailTemplates&action=EditView&return_module=EmailTemplates&return_action=DetailView',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_EMAIL_TEMPLATE_LIST',
			'tooltip' => 'LNK_EMAIL_TEMPLATE_LIST',
            'acl_action' => 'list',
            'type' => 'button',
            'acl_module' => 'EmailTemplates',
            'route'=>'#bwc/index.php?module=EmailTemplates&action=index',
            'icon' => 'fa-bars',
        ),
        array(


            'label' => 'LNK_NEW_EMAIL_SIGNATURE',
			'tooltip' => 'LNK_NEW_EMAIL_SIGNATURE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Emails',
            'route'=>'#UserSignatures/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' =>'LNK_EMAIL_SIGNATURE_LIST',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Emails',
            'route'=>'#UserSignatures',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_EMAIL_SETTINGS_LIST',
			'tooltip' => 'LNK_EMAIL_SETTINGS_LIST',
            'acl_action' => 'list',
            'type' => 'button',
            'acl_module' => 'OutboundEmail',
            'route'=>'#OutboundEmail',
            'icon' => 'fa-cog',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);