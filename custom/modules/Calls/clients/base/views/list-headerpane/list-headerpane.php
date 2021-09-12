<?php


    $viewdefs['Calls']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_CALLS',
        'buttons' => array(

            array(


                'label' => 'LNK_NEW_CALL',
                'tooltip' => 'LNK_NEW_CALL',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Calls',
                'route'=>'#Calls/create',
                'icon' => 'fa-plus',
            ),
            array(


                'label' => 'LNK_IMPORT_CALLS',
                'tooltip' => 'LNK_IMPORT_CALLS',
                'acl_action' => 'import',
                'type' => 'button',
                'acl_module' => 'Calls',
                'route'=>'#bwc/index.php?' . http_build_query(
                    array(
                        'module' => 'Import',
                        'action' => 'Step1',
                        'import_module' => 'Calls',
                        'query' => 'true',
                        'report_module' => 'Calls',
                    )
                ),
                'icon' => 'fa-cloud-upload',
            ),
            array(


                'label' => 'LBL_ACTIVITIES_REPORTS',
                'tooltip' => 'LBL_ACTIVITIES_REPORTS',
                'acl_action' => 'list',
                'type' => 'button',
                'acl_module' => 'Calls',
                'route'=>'#Reports?filterModule=Calls',
                'icon' => 'fa-user-chart',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
);