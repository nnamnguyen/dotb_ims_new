<?php


    $viewdefs['Contacts']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_CONTACTS',
        'buttons' => array(

            array(


                'label' => 'LNK_NEW_CONTACT',
                'tooltip' => 'LNK_NEW_CONTACT',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Contacts',
                'route'=>'#Contacts/create',
                'icon' => 'fa-plus',
            ),
            array(


                'label' => 'LNK_IMPORT_VCARD',
                'tooltip' => 'LNK_IMPORT_VCARD',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Contacts',
                'route'=>'#Contacts/vcard-import',
                'icon' => 'fa-address-card',
            ),
            array(


                'label' => 'LNK_CONTACT_REPORTS',
                'tooltip' => 'LNK_CONTACT_REPORTS',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'Reports',
                'route'=>'#Reports?filterModule=Contacts',
                'icon' => 'fa-user-chart',
            ),
            array(


                'label' => 'LNK_IMPORT_CONTACTS',
                'tooltip' => 'LNK_IMPORT_CONTACTS',
                'acl_action' => 'import',
                'type' => 'button',
                'acl_module' => 'Contacts',
                'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Contacts&return_module=Contacts&return_action=index',
                'icon' => 'fa-cloud-upload',
            ),
            array(


                'label' => 'LBL_SEND_SMS',
                'tooltip' => 'LBL_SEND_SMS',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'C_SMS',
                'route'=>'#bwc/index.php?module=C_SMS&action=sendSMS',
                'icon' => 'fa-comments',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
);