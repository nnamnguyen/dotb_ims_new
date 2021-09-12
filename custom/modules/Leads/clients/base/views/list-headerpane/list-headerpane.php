<?php


    $viewdefs['Leads']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_MODULE_NAME',
        'buttons' => array(

            array(

                'label' => 'LNK_NEW_LEAD',
                'tooltip' => 'LNK_NEW_LEAD',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Leads',
                'route'=>'#Leads/create',
                'icon' => 'fa-plus',
            ),
            array(


                'label' => 'LNK_IMPORT_VCARD',
                'tooltip' => 'LNK_IMPORT_VCARD',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Leads',
                'route'=>'#Leads/vcard-import',
                'icon' => 'fa-address-card',
            ),
            array(


                'label' => 'LNK_LEAD_REPORTS',
                'tooltip' => 'LNK_LEAD_REPORTS',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'Reports',
                'route'=>'#Reports?filterModule=Leads',
                'icon' => 'fa-user-chart',
            ),
            array(


                'label' => 'LNK_IMPORT_LEADS',
                'tooltip' => 'LNK_IMPORT_LEADS',
                'acl_action' => 'import',
                'type' => 'button',
                'acl_module' => 'Leads',
                'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Leads&return_module=Leads&return_action=index',
                'icon' => 'fa-cloud-upload',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
    );
